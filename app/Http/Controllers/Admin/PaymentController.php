<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Payment;
use App\Order;
use App\OrderDetail;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::all();
        return view('admin.payments.index', compact('payments'));
    }

    public function order(Payment $payment)
    {
        return view('admin.payments.order', compact('payment'));
    }

    public function orderDetails(Payment $payment,Order $order)
    {
        $orderDetails = $order->orderDetails;
        return view('admin.payments.order-details', compact('payment', 'order', 'orderDetails'));
    }
}
