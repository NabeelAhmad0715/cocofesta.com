<?php

namespace App\Providers;

use App\Cart;
use Illuminate\Support\ServiceProvider;
use App\Type;
use Illuminate\Support\Facades\View;
use App\GeneralSetting;
use App\ImageManager;
use App\Post;
use App\Whishlist;
use Illuminate\Support\Facades\Auth;

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
            $parentCategories = $type->categories->where('parent_category', null);
            $childCategories = $type->categories->where('parent_category', '!=', null);
            $posts = Post::orderBy('created_at')->get();
            if (Auth::user()) {
                $whishlistPosts = Whishlist::where('user_id', Auth::user()->id)->get();
                $whishlistCount = Whishlist::where('user_id', Auth::user()->id)->count();

                $cartPosts = Cart::where('user_id', Auth::user()->id)->where('deleted_at', null)->get();
                $cartCount = Cart::where('user_id', Auth::user()->id)->count();

                $totalPrice = Cart::where('user_id', Auth::user()->id)->where('in_stock', 1)->sum('price');

                $view->with(compact('type', 'parentCategories', 'posts', 'childCategories', 'whishlistPosts', 'whishlistCount', 'cartPosts', 'cartCount', 'totalPrice'));
            }
            $view->with(compact('type', 'parentCategories', 'posts', 'childCategories'));
        });
    }
}
