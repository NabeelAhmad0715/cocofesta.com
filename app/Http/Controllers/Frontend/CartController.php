<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $cartPosts = Cart::where('user_id', Auth::user()->id)->get();
            return view('frontend.pages.cart', compact('cartPosts'));
        } else {
            return view('frontend.pages.cart');
        }
    }

    public function create(Request $request)
    {
        $findPost = Cart::where('post_id', $request->product_id)->where('user_id', Auth::user()->id)->first();
        if (!$findPost) {
            if ($request->ajax()) {
                $product_id = $request->product_id;
                $cart = Cart::create([
                    'user_id' => Auth::user()->id,
                    'post_id' => $product_id,
                    'price' => $request->price,
                    'quantity' => 1,
                    'in_stock' => 1
                ]);
                return response()->json($cart);
            }
        } else {
            $cart = $findPost->update([
                'price' => ($findPost->price + $request->price),
                'quantity' => ($findPost->quantity + 1),
            ]);
            return response()->json($cart);
        }
    }

    public function count(Request $request)
    {
        if ($request->ajax()) {
            $cartCount = Cart::where('user_id', Auth::user()->id)->count();
            return response()->json($cartCount);
        }
    }

    public function remove(Request $request)
    {
        if ($request->ajax()) {
            $post_id = $request->post_id;
            $user_id = Auth::user()->id;
            $cart = Cart::where('user_id', $user_id)->where('post_id', $post_id)->delete();
            return response()->json($cart);
        } else {
            $cart = null;
            return response()->json($cart);
        }
    }

    public function quantity(Request $request)
    {
        if ($request->ajax()) {
            $quantity = $request->quantity;
            $price = $quantity * $request->price;
            $post_id = $request->post_id;
            $cart = Cart::where('user_id', Auth::user()->id)->where('post_id', $post_id)->first();
            $cart = $cart->update([
                'quantity' => $quantity,
                'price' => $price,
            ]);
            $cart = Cart::where('in_stock', '1')->get();
            return response()->json($cart);
        } else {
            $cart = null;
            return response()->json($cart);
        }
    }
}
