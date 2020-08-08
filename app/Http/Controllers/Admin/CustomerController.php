<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = User::all();
        return view('admin.customers.index', compact('customers'));
    }

    public function setStatus($id, $is_active)
    {
        $customer = User::where('id', $id)->first();
        $customer->is_active = $is_active;
        $customer->save();
        return response()->json($customer);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $request->session()->flash('message', 'Delete Image successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('customers.index');
    }
}
