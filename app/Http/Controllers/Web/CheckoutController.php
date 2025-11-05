<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $id = $request->query('id');
        $quantity = $request->query('quantity');
        $cart = [];
        $total = 0;

        if ($id && $quantity) {
            $product = Product::find($id);
            if ($product) {
                $subtotal = $product->offer_price * $quantity;
                $cart[] = [
                    'name' => $product->name,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
                $total = $subtotal;
            }
        } else {
            $sessionCart = session()->get('temp_cart', []);
            foreach ($sessionCart as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    $subtotal = $product->offer_price * $item['quantity'];
                    $cart[] = [
                        'name' => $product->name,
                        'quantity' => $item['quantity'],
                        'subtotal' => $subtotal,
                    ];
                    $total += $subtotal;
                }
            }
        }

        return view('web.checkout', compact('cart', 'total'));
    }
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'company_name' => 'nullable|string',
            'country' => 'required|string',
            'address_line_1' => 'required|string',
            'address_line_2' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'required|string',
            'order_notes' => 'nullable|string',
        ]);
        $user = User::where('email', $validated['email'])->where('roles', 'Customer')->first();

        if (!$user){
            $user = User::create([
            'name'  => $validated['first_name'] . ' ' . $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'roles' => 'Customer',
            ]);
        }

        $sessionCart = session()->get('temp_cart', []);
        if (empty($sessionCart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $totalAmount = 0;
        $totalQuantity = 0;
        $items = [];

        foreach ($sessionCart as $item) {
            $product = Product::find($item['id']);

            if (!$product) continue;

            $quantity = $item['quantity'];
            $unitAmount = $product->offer_price ?? 0;
            $itemTotal = $unitAmount * $quantity;
            $tax = $itemTotal * 0.1;
            $totalAmount += $itemTotal + $tax;
            $totalQuantity += $quantity;

            $items[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'unit_amount' => $unitAmount,
                'total_amount' => $itemTotal,
                'tax_amount' => $tax
            ];
        }
        $address = [
            'name' => $user->name,
            'company' => $validated['company_name'] ?? '',
            'country' => $validated['country'],
            'address' => $validated['address_line_1'] . ', ' . ($validated['address_line_2'] ?? ''),
            'city' => $validated['city'],
            'state' => $validated['state'],
            'zip' => $validated['zipcode'],
        ];

        $order = Order::create([
            'order_number'      => 'ORD-' . strtoupper(Str::random(8)),
            'user_id'           => $user->id,
            'total_amount'      => $totalAmount,
            'unit_amount'       => $totalAmount,
            'discount'          => 0,
            'total_quantity'    => $totalQuantity,
            'billing_address'   => json_encode($address),
            'delivery_address'  => json_encode($address),
            'total_before_tax'  => $totalAmount * 0.9,
            'tax_amount'        => $totalAmount * 0.1,
            'payment_type'      => 'COD',
            'order_status'      => 'order placed',
            'payment_status'    => 'Unpaid',
            'notes'             => $validated['order_notes'] ?? '',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item['product_id'],
                'user_id'       => $user->id,
                'quantity'      => $item['quantity'],
                'unit_amount'   => $item['unit_amount'],
                'total_amount'  => $item['total_amount'],
                'tax_amount'    => $item['tax_amount'],
                'status'        => 'order placed',
            ]);
            $product = Product::find($item['product_id']);
            if ($product) {
                $product->stock_quantity = max(0, $product->stock_quantity - $item['quantity']);
                $product->save();
            }
        }
        session()->forget('temp_cart');

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!',
            'order' => [
                'order_id' => $order->order_number,
                'order_date' => $order->created_at->format('d-m-Y'),
                'total_items' => $order->total_quantity,
                'total_amount' => $order->total_amount,
                'tax_amount' => $order->tax_amount,
                'order_status' => $order->order_status,
            ]
        ]);
        
    }
}