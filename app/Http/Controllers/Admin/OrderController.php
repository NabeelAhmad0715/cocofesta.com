<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderDetails = OrderDetail::all();
        return view('admin.orders.index', compact('orderDetails'));
    }

    public function show($id)
    {
        $orderDetail = OrderDetail::where('id', $id)->first();
        return view('admin.orders.show', compact('orderDetail'));
    }

    public function setOrderStatus($id, $status)
    {
        $orderDetail = OrderDetail::where('id', $id)->first();
        $orderDetail->status = $status;
        $orderDetail->save();
        return response()->json($orderDetail);
    }
}
