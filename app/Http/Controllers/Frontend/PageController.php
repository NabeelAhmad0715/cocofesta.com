<?php

namespace App\Http\Controllers\Frontend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\ContactEnquiry;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use App\Review;
use App\Type;
use Illuminate\Support\Facades\Auth;
use App\Cart;

class PageController extends Controller
{
    public function index()
    {
        $latestPosts = Post::latest()->take(9)->get();
        return view('frontend.pages.home', compact('latestPosts'));
    }

    public function dashboard()
    {
        $latestPosts = Post::latest()->take(9)->get();
        return view('frontend.pages.home', compact('latestPosts'));
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function product(Type $type)
    {
        $records = $type->posts;
        return view('frontend.pages.products', compact('type', 'records'));
    }

    public function productPost(Type $type, Post $post)
    {
        $relatedPosts = Post::where('id', '!=', $post->id)->get();
        if ($post->reviews->count() == 0) {
            if (Auth::user()) {
                $reviewCheckUser = $post->orderDetails->where('user_id', Auth::user()->id);
                $orderCheck = $post->orderDetails->where('user_id', Auth::user()->id)->count();
                $reviewCheck = $post->reviews->where('user_id', Auth::user()->id)->count();
                return view('frontend.pages.product-post', compact('post', 'reviewCheckUser', 'relatedPosts', 'reviewCheck', 'orderCheck'));
            } else {
                return view('frontend.pages.product-post', compact('post', 'relatedPosts'));
            }
        } else {
            $totalReviews = round(number_format((float) ($post->reviews->sum('rating') / $post->reviews->count()), 2, '.', ''));
            if (Auth::user()) {
                $reviewCheckUser = $post->orderDetails->where('user_id', Auth::user()->id);
                $orderCheck = $post->orderDetails->where('user_id', Auth::user()->id)->count();
                $reviewCheck = $post->reviews->where('user_id', Auth::user()->id)->count();
                return view('frontend.pages.product-post', compact('post', 'reviewCheckUser', 'totalReviews', 'relatedPosts', 'reviewCheck', 'orderCheck'));
            }
            return view('frontend.pages.product-post', compact('post', 'totalReviews', 'relatedPosts'));
        }
    }

    public function search(Request $request, Type $type)
    {
        if ($request->has('search')) {
            $search = $request->search;
            $records = $type->posts()->where('title', 'LIKE', "%{$search}%")->orwhere('slug', 'LIKE', "%{$search}%")->orwhere('slug', 'LIKE', "{$search}%")->orwhere('slug', 'LIKE', "%{$search}")->orwhere('title', 'LIKE', "{$search}%")->orwhere('title', 'LIKE', "%{$search}")->get();

            if (count($records) <= 0) {
                $records = $type->posts;
            }
        } else {
            $records = $type->posts;
        }
        return view('frontend.pages.products', compact('records', 'type'));
    }
    public function viewCart()
    {
        return view('frontend.pages.cart');
    }

    public function checkout()
    {
        $postCarts = Cart::where('user_id', Auth::user()->id)->where('deleted_at', null)->where('in_stock', 1)->get();
        return view('frontend.pages.checkout', compact('postCarts'));
    }

    public function contactUs()
    {
        return view('frontend.pages.contact-us');
    }

    public function thankyou()
    {
        return view('frontend.pages.thankyou');
    }



    public function contactEnquiry(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email'],
            'comment' => ['nullable', 'string'],
            'g-recaptcha-response' => new Captcha()
        ]);
        ContactEnquiry::create($data);

        Mail::to($request->email)->send(new ContactMail());

        $request->session()->flash('contact-message', 'Your Request Submit successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return Redirect::to(URL::previous());
    }

    public function setReviews(Request $request)
    {
        $review = Review::where('post_id', $request->post_id)->where('user_id', Auth::user()->id)->first();
        $post = Post::where('id', $request->post_id)->first();
        $placeOrderCheck = $post->orderDetails->where('user_id', Auth::user()->id)->count();
        $reviewCheck = $post->reviews->where('user_id', Auth::user()->id)->count();
        if ($request->ajax()) {
            if ($placeOrderCheck > $reviewCheck) {
                Review::create([
                    'rating' => $request->rating,
                    'message' => $request->message,
                    'user_id' => Auth::user()->id,
                    'post_id' => $request->post_id
                ]);
            }
            $reviews = Review::all();
            return response()->json($reviews);
        }
    }
}
