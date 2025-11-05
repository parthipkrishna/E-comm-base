<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sessionCart = session()->get('temp_cart', []);
        $cart = [];
        foreach ($sessionCart as $item) {
            $product = Product::find($item['id']);

            if ($product) {
                $cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image, // assuming 'image' column exists
                    'price' => $product->offer_price, // still use offer_price from session
                    'quantity' => $item['quantity'],
                    'stock_quantity' =>$product->stock_quantity,
                    'in_stock' =>$product->in_stock,
                ];
            }
        }
        return view('web.cart', compact('cart'));
    }

    public function add(Request $request)
    {
        \Log::info('Received add to session:', $request->all());
        $cart = session()->get('temp_cart', []);
        $productId = $request->id;
        // Check if product already in cart
        $found = false;
        foreach ($cart as &$item) {
            if ($item['id'] == $productId) {
                $item['quantity'] += 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = [
                'id' => $productId,
                'name' => $request->name,
                'price' => $request->offer_price,
                'quantity' => $request->quantity ?? 1,
            ];
        }

        session(['temp_cart' => $cart]);

        \Log::info('Updated session cart:', $cart);

        return response()->json(['success' => true]);
    }
    public function remove(Request $request)
    {
        $productId = $request->id;

        $cart = session()->get('temp_cart', []);
        $updatedCart = array_filter($cart, function ($item) use ($productId) {
            return $item['id'] != $productId;
        });
        $updatedCart = array_values($updatedCart);
        session(['temp_cart' => $updatedCart]);
        return response()->json([
            'success' => true,
            'cart_count' => count($updatedCart)
        ]);
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('temp_cart', []);

        foreach ($cart as &$item) {
            if ($item['id'] == $request->id) {
                if ($request->type === 'increment') {
                    $item['quantity'] += 1;
                } elseif ($request->type === 'decrement' && $item['quantity'] > 1) {
                    $item['quantity'] -= 1;
                }
                break;
            }
        }
        session(['temp_cart' => $cart]);
        return response()->json(['success' => true]);
    }
    public function getCart()
    {
        $sessionCart = session()->get('temp_cart', []);
        $cart = [];
        foreach ($sessionCart as $item) {
            $product = Product::find($item['id']);
            if ($product) {
                $cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'image' => $product->image,
                    'price' => $product->offer_price,
                    'quantity' => $item['quantity'],
                ];
            }
        }
        return response()->json($cart);
    }
    public function removeCartItem(Request $request)
    {
        $cart = session()->get('temp_cart', []);

        $cart = array_filter($cart, function ($item) use ($request) {
            return $item['id'] != $request->id;
        });

        session(['temp_cart' => $cart]);

        return response()->json([
            'success' => true,
            'empty' => empty($cart)
        ]);
    }

}
