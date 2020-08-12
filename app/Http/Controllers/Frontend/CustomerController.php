<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class CustomerController extends Controller
{
    public function profile()
    {
        return view('frontend.customers.profile');
    }

    public function editProfile(Request $request)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $data = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['nullable', 'string', 'min:8'],
            'new_password' => ['nullable', 'string', 'min:8'],
        ]);
        if ($data['password'] == null && $data['email'] == null && $data['name'] ==  null) {
            $request->session()->flash('message', 'First You Enter Fields');
            $request->session()->flash('alert-class', 'alert alert-success');
            return redirect()->route('customers.profile');
        }
        if ($data['password']) {
            if (Hash::check($data['password'], Auth::user()->password)) {
                $user->update([
                    'password' => Hash::make($data['new_password'])
                ]);
            } else {
                $request->session()->flash('message', 'Wrong Password');
                $request->session()->flash('alert-class', 'alert alert-danger');
                return redirect()->route('customers.profile');
            }
        }

        if ($data['email']) {
            $user->update([
                'password' => $data['email'],
            ]);
        }
        if ($data['name']) {
            $user->update([
                'password' => $data['name']
            ]);
        }

        $request->session()->flash('message', 'Profile updated Support successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('customers.profile');
    }
}
