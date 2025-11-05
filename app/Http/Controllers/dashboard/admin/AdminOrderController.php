<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('user')
            ->when($request->search, function ($query, $search) {
                $query->where('order_number', 'like', "%$search%");
            })
            ->latest()->get();
            
        return view('dashboard.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product', 'notes']);

        return view('admin.orders.show', compact('order'));
    }

    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.order.show')->with('success', 'Order deleted successfully.');
    }
    public function update($id)
    {
        $order = Order::with(['orderitems.product', 'notes'])->findOrFail($id);

        $grandTotal = $order->orderitems->sum('total_amount');
        $estimatedTax = $order->orderitems->sum('tax_amount');
        $finalTotal = $grandTotal + $estimatedTax;
        $billingAddress = json_decode($order->billing_address, true);
        $data = [
            'order' => $order,
            'billingAddress' => $billingAddress,
            'grandTotal' => $grandTotal,
            'estimatedTax' => $estimatedTax,
            'finalTotal' => $finalTotal,
            'paymentStatuses' => ['Paid', 'Unpaid', 'Payment Failed', 'Awaiting Authorization'],
        ];

        return view('dashboard.order_details.index', $data);
    }

    public function updateOrderStatusBasedOnItems($orderId)
    {
        $order = Order::findOrFail($orderId);
        $orderItems = $order->orderItems;
        // Get all unique statuses from order items
        $uniqueStatuses = $orderItems->pluck('status')->unique(); 
        // If all items have the same status, update the order status
        if ($uniqueStatuses->count() === 1) {
            $newStatus = $uniqueStatuses->first(); 
            // Only update if status is different
            if ($order->order_status !== $newStatus) {
                $order->order_status = $newStatus;
                $order->save();
                return true; // Status was updated
            }
        } 
        return false; // Status was not updated
    }
    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|in:order placed,processing,shipped,delivered,cancelled',
            'shipping_vendor' => 'required_if:order_status,shipped',
            'tracking_number' => 'required_if:order_status,shipped',
        ]);

        $order = Order::findOrFail($id);
        $order->order_status = $request->order_status;
        if ($request->order_status === 'shipped') {
            $order->shipping_vendor = $request->shipping_vendor;
            $order->tracking_number = $request->tracking_number;
        }

        $order->save();

        OrderItem::where('order_id', $order->id)
        ->update(['status' => $request->order_status]);

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
    public function updatePaymentStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
            $request->validate([
                'payment_method' => 'required|string',
                'transaction_id' => 'required|string',
                'payment_received_date' => 'required|date',
                'payment_attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp'
            ]);

            $order->payment_method = $request->payment_method;
            $order->transaction_id = $request->transaction_id;
            $order->payment_received_date = $request->payment_received_date;
            $order->payment_status = $request->payment_status;
            $order->payment_type = $request->payment_status;

            if ($request->hasFile('payment_attachment')) {
                $filePath = $request->file('payment_attachment')->store('payment_attachments', 'public');
                $order->payment_attachment = $filePath;
            }

        $order->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }
}