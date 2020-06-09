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

class PageController extends Controller
{
    public function index()
    {
        return view('frontend.pages.home');
    }

    public function about()
    {
        return view('frontend.pages.about');
    }

    public function product($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $categoryPosts = $category->posts;
        return view('frontend.pages.products', compact('categoryPosts', 'category'));
    }

    public function productPost($category, $slug)
    {
        $category = Category::where('slug', $category)->first();
        $post = Post::where('slug', $slug)->first();
        return view('frontend.pages.product-post', compact('post'));
    }

    public function search(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($request->has('search')) {
            $search = $request->search;
            $categoryPosts = $category->posts()->where('title', 'LIKE', "%{$search}%")->orwhere('slug', 'LIKE', "%{$search}%")->orwhere('slug', 'LIKE', "{$search}%")->orwhere('slug', 'LIKE', "%{$search}")->orwhere('title', 'LIKE', "{$search}%")->orwhere('title', 'LIKE', "%{$search}")->get();

            if (count($categoryPosts) <= 0) {
                $categoryPosts = $category->posts;
            }
        } else {
            $categoryPosts = $category->posts;
        }
        return view('frontend.pages.products', compact('categoryPosts', 'category'));
    }
    public function viewCart()
    {
        return view('frontend.pages.cart');
    }

    public function checkout()
    {
        return view('frontend.pages.checkout');
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
            'name' => ['required', 'string', 'max:191'],
            'phone' => ['required', 'string', 'max:191'],
            'email' => ['required', 'email'],
            'comment' => ['nullable', 'string'],
            'g-recaptcha-response' => new Captcha()
        ]);
        ContactEnquiry::create($data);

        Mail::to($request->email)->send(new ContactMail());

        $request->session()->flash('message', 'Your Request Submit successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return Redirect::to(URL::previous());
    }
}
