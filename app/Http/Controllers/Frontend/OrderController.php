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
use Omnipay\Omnipay;
use App\Payment;

class OrderController extends Controller
{
    public $gateway;

    public function __construct()
    {
        $this->gateway = Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId(config('app.paypal_key'));
        $this->gateway->setSecret(config('app.paypal_secret'));
        $this->gateway->setTestMode(true); //set it to 'false' when go live
    }

    public function order(Request $request)
    {
        if ($request->price == 0) {
            $request->session()->flash('message', 'First you can add a product');
            $request->session()->flash('alert-class', 'alert alert-success');
            return redirect()->back();
        }

        if ($request->method == 'stripe') {
            $price = $request->price;
            Stripe\Stripe::setApiKey(config('app.stripe_secret'));
            Stripe\Charge::create([
                "amount" => $price * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "payment from As Fine Leather",
            ]);

            $data = [
                'fullname' => Auth::user()->name,
                'email' => Auth::user()->email,
                'address' => Auth::user()->address,
                'phone' => Auth::user()->phone,
                'user_id' => Auth::user()->id
            ];
            $this->orderCreate($data);
        } else if ($request->method === 'paypal') {
            try {
                $response = $this->gateway->purchase(array(
                    'amount' => $request->post('amount'),
                    'currency' => config('app.paypal_currency'),
                    'returnUrl' => url('paymentsuccess'),
                    'cancelUrl' => url('paymenterror'),
                ))->send();
                if ($response->isRedirect()) {
                    $response->redirect(); // this will automatically forward the customer
                } else {
                    // not successful
                    return $response->getMessage();
                }
            } catch (Exception $e) {
                return $e->getMessage();
            }
        } else {
            return redirect()->back();
        }

        // $order = Order::create($data);
        // $cartPosts = Cart::where('user_id', Auth::user()->id)->where('in_stock', 1)->get();
        // $orderNumber = 'AS' . rand(1, 10000);
        // foreach ($cartPosts as $post) {

        //     $orderDetail = OrderDetail::create([
        //         'user_id' => $data['user_id'],
        //         'order_id' => $order->id,
        //         'post_id' => $post->post_id,
        //         'price' => $post->price,
        //         'quantity' => $post->quantity,
        //         'order_number' => $orderNumber,
        //         'size' => $post->size,
        //         'color' => $post->color,
        //     ]);
        //     $size = "available_" . str_replace('-', '_', $orderDetail->size) . "_quantity";
        //     $metaData = $orderDetail->post->metaData->where('name', $size)->first();
        //     $metaDataPost = MetaDataPost::where('meta_data_id', $metaData->id)->where('post_id', $orderDetail->post_id)->first();
        //     $updatedQuantity = ((int)$metaDataPost->value) - $orderDetail->quantity;
        //     $metaDataPost->update([
        //         'value' => $updatedQuantity
        //     ]);
        //     if (((int)$metaDataPost->value) <= 0) {
        //         $sizes = [];
        //         foreach (explode(',', $orderDetail->post->available_size) as $key => $availableSize) {
        //             if ($availableSize != $orderDetail->size) {
        //                 $sizes[] = $availableSize;
        //             }
        //         }
        //         $orderDetail->post->update([
        //             'available_size' => implode(',', $sizes),
        //         ]);
        //     }
        //     if (!$orderDetail->post->available_size) {
        //         $orderDetail->post->update([
        //             'in_stock' => 0
        //         ]);
        //     }
        //     $post->delete();
        // }
        $request->session()->flash('message', 'Order has been placed successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('pages.thankyou');
    }

    public function orderCreate($data){
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
                'color' => $post->color,
            ]);
            $size = "available_" . str_replace('-', '_', $orderDetail->size) . "_quantity";
            $metaData = $orderDetail->post->metaData->where('name', $size)->first();
            $metaDataPost = MetaDataPost::where('meta_data_id', $metaData->id)->where('post_id', $orderDetail->post_id)->first();
            $updatedQuantity = ((int)$metaDataPost->value) - $orderDetail->quantity;
            $metaDataPost->update([
                'value' => $updatedQuantity
            ]);
            if (((int)$metaDataPost->value) <= 0) {
                $sizes = [];
                foreach (explode(',', $orderDetail->post->available_size) as $key => $availableSize) {
                    if ($availableSize != $orderDetail->size) {
                        $sizes[] = $availableSize;
                    }
                }
                $orderDetail->post->update([
                    'available_size' => implode(',', $sizes),
                ]);
            }
            if (!$orderDetail->post->available_size) {
                $orderDetail->post->update([
                    'in_stock' => 0
                ]);
            }
            $post->delete();
        }
    }

    public function payment_success(Request $request)
    {
        $data = [
            'fullname' => Auth::user()->name,
            'email' => Auth::user()->email,
            'address' => Auth::user()->address,
            'phone' => Auth::user()->phone,
            'user_id' => Auth::user()->id
        ];
        // Once the transaction has been approved, we need to complete it.
        if ($request->input('paymentId') && $request->input('PayerID')) {
            $transaction = $this->gateway->completePurchase(array(
                'payer_id'             => $request->input('PayerID'),
                'transactionReference' => $request->input('paymentId'),
            ));
            $response = $transaction->send();

            if ($response->isSuccessful()) {

                $this->orderCreate($data);
                // The customer has successfully paid.
                $arr_body = $response->getData();

                // Insert transaction data into the database
                $isPaymentExist = Payment::where('payment_id', $arr_body['id'])->first();

                if (!$isPaymentExist) {
                    $payment = new Payment();
                    $payment->payment_id = $arr_body['id'];
                    $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                    $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                    $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                    $payment->currency = config('app.paypal_currency');
                    $payment->payment_status = $arr_body['state'];
                    $payment->save();
                }


                $request->session()->flash('message', "Payment is successful. Your transaction id is: " . $arr_body['id']);
                $request->session()->flash('alert-class', 'alert alert-success');
                return redirect()->route('pages.thankyou');
            } else {
                return $response->getMessage();
            }
        } else {
            return 'Transaction is declined';
        }
    }

    public function payment_error()
    {
        $request->session()->flash('message', 'User is cancel the payment');
        $request->session()->flash('alert-class', 'alert alert-danger');
        return redirect()->route('pages.checkout');
    }
}
