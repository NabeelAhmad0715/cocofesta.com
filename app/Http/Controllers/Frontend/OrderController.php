<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Order;
use Illuminate\Support\Facades\Auth;
use App\Cart;
use App\OrderDetail;
use Stripe;
use App\MetaDataPost;

class OrderController extends Controller
{
    public function order(Request $request)
    {
        $data = $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email'],
            'address' => ['required', 'string', 'max:255'],
            'postal_code' => ['nullable', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'message' => ['nullable', 'string'],
        ]);

        $price = $request->price;
        // Stripe\Stripe::setApiKey(config('app.stripe_secret'));
        // Stripe\Charge::create([
        //     "amount" => $price * 100,
        //     "currency" => "usd",
        //     "source" => $request->stripeToken,
        //     "description" => "payment from As Fine Leather"
        // ]);

        $data['user_id'] = Auth::user()->id;
        $order = Order::create($data);
        $cartPosts = Cart::where('user_id', Auth::user()->id)->where('in_stock', 1)->get();
        $orderNumber = 'AS' . rand(1, 10000);
        foreach ($cartPosts as $post) {

            $orderDetail = OrderDetail::create([
                'user_id' => $data['user_id'],
                'order_id' => $order->id,
                'post_id' => $post->post_id,
                'price' => $post->price,
                'quantity' => $post->quantity,
                'order_number' => $orderNumber,
                'size' => $post->size,
            ]);
            $size = "available_" . $orderDetail->size . "_quantity";
            $metaData = $orderDetail->post->metaData->where('name', $size)->first();
            $metaDataPost = MetaDataPost::where('meta_data_id', $metaData->id)->where('post_id', $orderDetail->post_id)->first();
            $quantity = ((int)$metaDataPost->value) - $orderDetail->quantity;
            $metaDataPost->update([
                'value' => $quantity
            ]);
            if (((int)$metaDataPost->value) <= 0) {
                foreach (explode(',', $orderDetail->post->available_size) as $key => $availableSize) {
                    if ($availableSize != $orderDetail->size) {
                        $orderDetail->post->update([
                            'available_size' => $availableSize
                        ]);
                    }
                }
            }
            if (!$orderDetail->post->availableSize) {
                $orderDetail->post->update([
                    'in_stock' => 0
                ]);
            }
            $post->delete();
        }
        $request->session()->flash('message', 'Order has been placed successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('pages.thankyou');
    }
}
