<?php

namespace App\Http\Controllers\dashboard\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class AdminOrderDetailsController extends Controller
{
        public function index($id)
    {
        $ordera = Order::with(['orderitems.product', 'notes'])->findOrFail($id);

        return view('dashboard.order_details.index', compact('orders'));
    }

        public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:order placed,processing,shipped,delivered,cancelled',
        ]);
        $item = OrderItem::findOrFail($id);
        $item->status = $request->status;
        $item->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array',
            'item_ids.*' => 'exists:order_items,id',
            'status' => 'required|in:order placed,processing,shipped,delivered,cancelled',
            'update_progress' => 'required|boolean'
        ]);

        $updateProgress = (bool)$request->update_progress;
        $orderIds = OrderItem::whereIn('id', $request->item_ids)
            ->pluck('order_id')
            ->unique();

        $updateCount = OrderItem::whereIn('id', $request->item_ids)
            ->update(['status' => $request->status]);
        Order::whereIn('id', $orderIds)->update(['order_status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Status updated successfully',
            'update_progress' => $updateProgress
        ]);
    }
    public function checkStatus(Order $order)
    {
        $uniqueStatuses = $order->orderitems()->pluck('status')->unique();
        
        return response()->json([
            'all_same' => $uniqueStatuses->count() === 1,
            'current_status' => $uniqueStatuses->count() === 1 ? $uniqueStatuses->first() : null
        ]);
    }
    public function bulkPaymentStatusUpdate(Request $request, $id)
    {
        $request->validate([
            'payment_status' => 'required|in:Paid,Unpaid,Payment Failed,Awaiting Authorization',
        ]);
        $order = Order::findOrFail($id);
        $order->payment_status = $request->payment_status;
        if ($request->payment_status === 'Paid') {
            $order->payment_type = 'Paid';
        }
        $order->save();

        return redirect()->back()->with('success', 'Payment status updated successfully.');
    }

}