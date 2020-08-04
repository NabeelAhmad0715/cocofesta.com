<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\ImageManager;
use Illuminate\Http\Request;
use App\Category;
use App\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index')->with(compact(['categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::all();
        $images = ImageManager::all()->sortByDesc("id");
        $types = Type::all();
        return view('admin.category.create', compact('categories', 'images', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'parent_category' => ['nullable', 'exists:categories,id'],
            'title' => Rule::unique('categories', 'title')->where(function ($query) {
                return $query->where('type_id', request("type_id"));
            }),
            'display_order' => 'numeric',
            'type_id' => ['required', 'integer'],
        ]);

        $slug = Str::slug($request->title, '-');
        $category = Category::create([
            'parent_category' => $request->parent_category,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slug' => $slug,
            'type_id' => $request->type_id,
            'display_order' => $request->display_order,
            'body' => $request->body,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        //Header Images
        $headerImages = json_decode($request->header_image, true);
        $id = $category->id;
        if (is_array($headerImages)) {
            foreach ($headerImages as $image) {
                $i = Image::create([
                    'image_manager_id' => $image['id'],
                    'image_type' => 'header',
                    'imageable_id' => $id,
                    'imageable_type' => Category::class,
                ]);
            }
        }

        //Featured Images
        $featuredImage = json_decode($request->featured_image, true);
        if ($featuredImage) {
            foreach ($featuredImage as $image) {
                $i = Image::create([
                    'image_manager_id' => $image['id'],
                    'image_type' => 'featured',
                    'imageable_id' => $id,
                    'imageable_type' => Category::class,
                ]);
            }
        }
        return redirect()->route('categories.index')->with('success', 'Category has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $allCategories = Category::all();
        $images = ImageManager::all()->sortByDesc("id");
        $types = Type::all();
        $headerImages = $category->images('header');
        $featuredImage = $category->images('featured');
        return view('admin.category.edit', compact('category', 'allCategories', 'headerImages', 'featuredImage', 'images', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'parent_category' => ['sometimes', 'nullable', 'exists:categories,id'],
            'title' => ['required', 'max:255', 'unique:categories,title,' . $category->id],
            'display_order' => 'numeric',
            'type_id' => ['required', 'integer'],
        ]);

        $slug = Str::slug($request->title, '-');
        $category->update([
            'parent_category' => $request->parent_category,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'slug' => $slug,
            'type_id' => $request->type_id,
            'display_order' => $request->display_order,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        $headerImages = collect(json_decode($request->header_image, true))->pluck('id');
        $category->imageDetach('header', $headerImages);
        $category->imageUpdate('header', $headerImages);

        //Featured Images
        if ($request->featured_image != '[]') {
            $featuredImage = json_decode($request->featured_image, true)[0]['id'];
            $category->imageDetach('featured', [$featuredImage]);
            $category->imageUpdate('featured', [$featuredImage]);
        }

        return redirect()->route('categories.edit', $category->id)->with('success', 'Category has been updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $category)
    {
        foreach ($category->posts as $post) {
            $post->tags()->detach();
            foreach ($post->metaDataPost as $key => $data) {
                Storage::delete('public/' . $data->value);
            }
            $post->metaDataPost()->delete();
            \App\CategoryPost::where('post_id', $post->id)->delete();
            $post->delete();
        }

        \App\Image::where(['imageable_id' => $category->id, 'imageable_type' => Category::class])->delete();
        $category->delete();
        return redirect()->back()->with('success', 'Category has been deleted successfully!');
    }
}
