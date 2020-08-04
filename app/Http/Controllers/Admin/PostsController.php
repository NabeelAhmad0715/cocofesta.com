<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;
use App\Post;
use App\MetaDataPost;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Tag;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slug)
    {
        $type = Type::where('slug', $slug)->first();
        $posts = Post::where('type_id', $type->id)->get();
        $columns = $type->metaData()->where("is_visible", 1)->get();
        return view('admin.posts.index', compact('posts', 'type', 'columns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $type = Type::where('slug', $slug)->first();
        $categories = $type->categories;
        return view('admin.posts.create', compact('type', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $slug)
    {
        $type = Type::where('slug', $slug)->first();

        $data = $request->validate([
            'type_id' => ['required'],
            'title' => ['required', 'string', 'max:191', 'unique:posts'],
        ]);
        $data['slug'] = Str::slug($data['title'], '-');
        $post = Post::create($data);

        foreach ($type->metaData as $key => $field) {
            if ($field->field_type == 'file') {
                $images = [];
                if ($request->file($field->name)) {
                    $value = $field->name;
                    if (is_array($request->$value)) {
                        foreach ($request->$value as $image) {
                            $filename = Str::random(15) . '.' . $image->getClientOriginalExtension();
                            Storage::putFileAs('public', $image, $filename);
                            $images[] = $filename;
                        }
                        $value = implode(',', $images);
                    } else if ($request->$value) {
                        $image = $request->$value;
                        $filename = Str::random(15) . '.' . $image->getClientOriginalExtension();
                        Storage::putFileAs('public', $image, $filename);
                        $value = $filename;
                    }
                }
            } else {
                $value = $request->post($field->name);
            }
            MetaDataPost::create([
                'post_id' => $post->id,
                'meta_data_id' => $field->id,
                'value' => $value
            ]);
        }

        if ($request->category_id) {
            $post->categories()->sync($request->category_id);
        }

        if ($request->tags) {
            $tagList = explode(",", $request->tags);
            foreach ($tagList as $tags) {
                $tagSlug = Str::slug($tags, '-');
                $tag = Tag::create(['name' => $tags, 'slug' => $tagSlug]);
            }
            $tags = Tag::whereIn('name', $tagList)->get()->pluck('id');
            $post->tags()->sync($tags, false);
        }

        $request->session()->flash('message', 'New post created successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('posts.index', ['slug' => $type->slug]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug, $id)
    {
        $post = Post::where('id', $id)->first();
        $type = Type::where('slug', $slug)->first();
        $categories = $type->categories;
        $names = array_column($post->tags->toArray(), 'name');
        $tags = implode(',', $names);
        return view('admin.posts.edit', compact('post', 'type', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug, $id)
    {
        $post = Post::where('id', $id)->first();
        $type = Type::where('slug', $slug)->first();

        $request->validate([
            'title' => ['required', 'string', 'max:191', 'unique:posts,title,' . $post->id]
        ]);
        $slug = Str::slug($request->title, '-');
        $post->update([
            'type_id' => $type->id,
            'title' => $request->title,
            'slug' => $slug
        ]);
        foreach ($type->metaData as $key => $field) {
            $metaData = MetaDataPost::where('post_id', $post->id)->where('meta_data_id', $field->id)->first();
            if ($metaData == null) {
                if ($field->field_type == 'file') {
                    $images = [];
                    if ($request->file($field->name)) {
                        $value = $field->name;
                        if (is_array($request->$value)) {
                            foreach ($request->$value as $image) {
                                $filename = Str::random(15) . '.' . $image->getClientOriginalExtension();
                                Storage::putFileAs('public', $image, $filename);
                                $images[] = $filename;
                            }
                            $value = implode(',', $images);
                        } else if ($request->$value) {
                            $image = $request->$value;
                            $filename = Str::random(15) . '.' . $image->getClientOriginalExtension();
                            Storage::putFileAs('public', $image, $filename);
                            $value = $filename;
                        }
                    }
                } else {
                    $value = $request->post($field->name);
                }
                MetaDataPost::create([
                    'post_id' => $post->id,
                    'meta_data_id' => $field->id,
                    'value' => $value
                ]);
            } else {
                if ($field->field_type == 'file' && $field->multiple == 1) {
                    if (isset($metaData->value)) {
                        $image = $field->name;
                        if ($metaData->value == "") {
                            $images = [];
                        } else {
                            $images = [];
                            $images[] = $metaData->value;
                        }

                        if (is_array($request->$image)) {
                            foreach ($request->$image as $image) {
                                $filename = Str::random(15) . '.' . $image->getClientOriginalExtension();
                                Storage::putFileAs('public', $image, $filename);
                                $images[] = $filename;
                            }
                            $value = implode(',', $images);
                        } else {
                            $value = $metaData->value;
                        }
                    }
                } else if ($field->field_type == 'file' && $field->multiple == 0) {
                    $name = $field->name;
                    $image = $request->$name;
                    if ($image) {
                        $filename = Str::random(15) . '.' . $image->getClientOriginalExtension();
                        Storage::putFileAs('public', $image, $filename);
                        $value = $filename;
                    } else {
                        $value = $metaData->value;
                    }
                } else {

                    $value = $request->post($field->name);
                }

                $metaData->update([
                    'post_id' => $post->id,
                    'meta_data_id' => $field->id,
                    'value' => $value
                ]);
            }
        }
        if ($request->category_id) {
            $post->categories()->sync($request->category_id);
        }

        if ($request->tags) {
            $post->tags()->detach();
            $tagList = explode(",", $request->tags);
            foreach ($tagList as $tags) {
                $tagSlug = Str::slug($tags, '-');
                $tag = Tag::firstOrCreate(['name' => $tags, 'slug' => $tagSlug]);
            }
            $tags = Tag::whereIn('name', $tagList)->get()->pluck('id');
            $post->tags()->sync($tags, false);
        }

        $request->session()->flash('message', 'New post updated successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('posts.index', ['slug' => $type->slug]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $slug, $id)
    {

        $post = Post::where('id', $id)->first();
        $type = Type::where('slug', $slug)->first();
        $post->tags()->detach();
        Post::destroy($post->id);
        $metaDatas = MetaDataPost::where('post_id', $post->id)->get();

        foreach ($metaDatas as $key => $data) {

            Storage::delete('public/' . $data->value);
        }

        $metaDatas = MetaDataPost::where('post_id', $post->id)->delete();
        $request->session()->flash('message', 'Post deleted successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('posts.index', ['slug' => $type->slug]);
    }

    public function delete(Request $request, $id, $postId, $image)
    {
        $metaData = MetaDataPost::where('meta_data_id', $id)->where('post_id', $postId)->first();
        $images = [];
        $remainingImages = [];
        $images = explode(',', $metaData->value);

        foreach ($images as $key => $postImage) {
            if ($postImage == $image) {
                Storage::delete('public/' . $image);
            } else {
                $remainingImages[] = $postImage;
            }
        }
        $remainingImages = implode(',', $remainingImages);
        $metaData->update([
            'post_id' => $postId,
            'meta_data_id' => $id,
            'value' => $remainingImages
        ]);

        $request->session()->flash('message', 'Delete Image successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->back();
    }
}
