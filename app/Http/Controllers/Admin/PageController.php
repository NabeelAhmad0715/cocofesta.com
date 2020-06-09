<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tag;
use App\Post;
use App\Cart;

class PageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.pages.home');
    }

    public function tags()
    {
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function setStockStatus($id, $in_stock)
    {
        $post = Post::where('id', $id)->first();
        $post->in_stock = $in_stock;
        $post->save();

        $cart = Cart::where('post_id', $id)->first();
        $cart->in_stock = $in_stock;
        $cart->save();

        return response()->json($post);
    }
}
