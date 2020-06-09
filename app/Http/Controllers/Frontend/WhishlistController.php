<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Whishlist;
use Illuminate\Support\Facades\Auth;

class WhishlistController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $whishlistPosts = Whishlist::where('user_id', Auth::user()->id)->get();
            return view('frontend.pages.whishlist', compact('whishlistPosts'));
        } else {
            return view('frontend.pages.whishlist');
        }
    }

    public function create(Request $request)
    {
        $findPost = Whishlist::where('post_id', $request->product_id)->first();
        if (!$findPost) {
            if ($request->ajax()) {
                $product_id = $request->product_id;
                $whishlist = Whishlist::create([
                    'user_id' => Auth::user()->id,
                    'post_id' => $product_id
                ]);
                return response()->json($whishlist);
            }
        } else {
            $whishlist = null;
            return response()->json($whishlist);
        }
    }

    public function count(Request $request)
    {
        if ($request->ajax()) {
            $whishlistCount = Whishlist::where('user_id', Auth::user()->id)->count();
            return response()->json($whishlistCount);
        }
    }

    public function remove(Request $request)
    {
        if ($request->ajax()) {
            $post_id = $request->post_id;
            $user_id = Auth::user()->id;
            $whishlist = Whishlist::where('user_id', $user_id)->where('post_id', $post_id)->delete();
            return response()->json($whishlist);
        } else {
            $whishlist = null;
            return response()->json($whishlist);
        }
    }
}
