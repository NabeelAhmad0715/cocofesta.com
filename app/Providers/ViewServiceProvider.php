<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Support\ServiceProvider;
use App\Type;
use Illuminate\Support\Facades\View;
use App\GeneralSetting;
use App\ImageManager;
use App\OrderDetail;
use App\Post;
use App\Whishlist;
use App\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['admin.*'], function ($view) {
            $types = Type::all();
            $settings = GeneralSetting::first();
            $images = ImageManager::orderBy('id', 'desc')->paginate(20);
            $view->with(compact('types', 'settings', 'images'));
        });
        View::composer(['frontend.*'], function ($view) {
            $type = Type::first();
            $posts = Post::orderBy('created_at')->get();
            $reviews = Review::all();
            $topRatedPosts = Review::orderBy('rating', 'desc')->take(3)->get();

            $popularPosts = OrderDetail::select('post_id', DB::raw('count(*) as total'))->groupBy('post_id')->orderBy('total', 'desc')->take(3)->get();

            if (Auth::user()) {
                $whishlistPosts = Whishlist::where('user_id', Auth::user()->id)->get();
                $whishlistCount = Whishlist::where('user_id', Auth::user()->id)->count();

                $cartPosts = Cart::where('user_id', Auth::user()->id)->where('deleted_at', null)->get();
                $cartCount = Cart::where('user_id', Auth::user()->id)->count();

                $totalPrice = Cart::where('user_id', Auth::user()->id)->where('in_stock', 1)->sum('price');

                $view->with(compact('type', 'posts', 'whishlistPosts', 'whishlistCount', 'cartPosts', 'cartCount', 'totalPrice'));
            }
            $view->with(compact('type', 'posts', 'reviews'));
        });
    }
}
