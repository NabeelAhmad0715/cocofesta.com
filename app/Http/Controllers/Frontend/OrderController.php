<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\OrderDetail;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $data = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'address' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        $data['user_id'] = Auth::user()->id;
        $order = Order::create($data);
        $cartPosts = Cart::where('user_id', Auth::user()->id)->get();
        $orderNumber = 'CF' . rand(1, 10000);
        foreach ($cartPosts as $post) {

            OrderDetail::create([
                'user_id' => $data['user_id'],
                'order_id' => $order->id,
                'post_id' => $post->post_id,
                'price' => $post->price,
                'quantity' => $post->quantity,
                'order_number' => $orderNumber,
            ]);

            $post->delete();
        }
        $request->session()->flash('message', 'Order has been placed successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('pages.thankyou');
    }
}
