<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Type;
use Illuminate\Support\Str;
use App\Image;
use Illuminate\Support\Facades\Storage;
use App\MetaData;
use App\ImageManager;

class TypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $images = ImageManager::all()->sortByDesc("id");
        return view('admin.types.create', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'introduction' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
        ]);
        $data['slug'] = Str::slug($request->title, '-');
        $type = Type::create($data);

        //Header Images
        $headerImages = json_decode($request->header_image, true);
        $id = $type->id;
        if (is_array($headerImages)) {
            foreach ($headerImages as $image) {
                $i = Image::create([
                    'image_manager_id' => $image['id'],
                    'image_type' => 'header',
                    'imageable_id' => $id,
                    'imageable_type' => Type::class,
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
                    'imageable_type' => Type::class,
                ]);
            }
        }

        $request->session()->flash('old-fields', $request->only('label_name', 'name', 'field_type', 'required', 'classes', 'multiple', 'field_visible'));

        $label_name = $request->label_name;
        $name = $request->name;
        $field_type = $request->field_type;
        $required = $request->required;
        $classes = $request->classes;
        $multiple = $request->multiple;
        $isVisible = $request->field_visible;

        $insertData = [];
        for ($i = 0; $i < count($label_name); $i++) {
            if ($label_name[$i] == null && $field_type[$i] == null &&  $name[$i] == null &&  $multiple[$i] == 0 && $classes[$i] == null && $required[$i] == 0 && $isVisible[$i] == 0) {
            } else {
                $data = array(
                    'type_id' => $type->id,
                    'label_name' => $label_name[$i],
                    'field_type' => $field_type[$i],
                    'name' => Str::slug($name[$i], '_'),
                    'multiple' => $multiple[$i],
                    'classes' => $classes[$i],
                    'required' => $required[$i],
                    'is_visible' => $isVisible[$i],
                );
                $insertData[] = $data;
            }
        }
        MetaData::insert($insertData);
        $request->session()->flash('message', 'New type created successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('types.index');
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
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        $images = ImageManager::all()->sortByDesc("id");
        $headerImages = $type->images('header');
        $featuredImage = $type->images('featured');
        return view('admin.types.update', compact('type', 'images', 'headerImages', 'featuredImage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'introduction' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_keywords' => ['nullable', 'string'],
            'meta_description' => ['nullable', 'string'],
        ]);
        $data['slug'] = Str::slug($request->title, '-');
        $type->update($data);

        $headerImages = collect(json_decode($request->header_image, true))->pluck('id');
        $type->imageDetach('header', $headerImages);
        $type->imageUpdate('header', $headerImages);

        //Featured Images
        if ($request->featured_image != '[]') {
            $featuredImage = json_decode($request->featured_image, true)[0]['id'];
            $type->imageDetach('featured', [$featuredImage]);
            $type->imageUpdate('featured', [$featuredImage]);
        }

        $request->session()->flash('old-fields', $request->only('label_name', 'name', 'field_type', 'required', 'classes', 'multiple', 'field_visible', 'meta_data_id'));

        $label_name = $request->label_name;
        $name = $request->name;
        $field_type = $request->field_type;
        $required = $request->required;
        $classes = $request->classes;
        $multiple = $request->multiple;
        $isVisible = $request->field_visible;
        $metaDataIds = $request->meta_data_id;
        $insertData = [];
        for ($i = 0; $i < count($label_name); $i++) {
            if ($label_name[$i] == null && $field_type[$i] == null &&  $name[$i] == null &&  $multiple[$i] == 0 && $classes[$i] == null && $required[$i] == 0 && $isVisible[$i] == 0) {
            } else {
                if ($i > (count($metaDataIds) - 1)) {
                    MetaData::create([
                        'type_id' => $type->id,
                        'label_name' => $label_name[$i],
                        'field_type' => $field_type[$i],
                        'name' => Str::slug($name[$i], '_'),
                        'multiple' => $multiple[$i],
                        'classes' => $classes[$i],
                        'required' => $required[$i],
                        'is_visible' => $isVisible[$i],
                    ]);
                } else {
                    $data = [
                        'id' => $metaDataIds[$i],
                        'type_id' => $type->id,
                        'label_name' => $label_name[$i],
                        'field_type' => $field_type[$i],
                        'name' => Str::slug($name[$i], '_'),
                        'multiple' => $multiple[$i],
                        'classes' => $classes[$i],
                        'required' => $required[$i],
                        'is_visible' => $isVisible[$i],
                    ];
                    $metaData = MetaData::where('id', $metaDataIds[$i])->first();
                    $metaData->update($data);
                }
            }
        }

        $request->session()->flash('message', 'Type updated successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Type $type)
    {
        $type->categories()->delete();
        foreach ($type->posts as $post) {
            $post->tags()->detach();
            foreach ($post->metaDataPost as $key => $data) {
                Storage::delete('public/' . $data->value);
            }
            $post->metaDataPost()->delete();
            \App\CategoryPost::where('post_id', $post->id)->delete();
            $post->delete();
        }
        $type->metaData()->delete();
        \App\Image::where('imageable_id', $type->id)->where('imageable_type', Type::class)->delete();
        $type->delete();
        $request->session()->flash('message', 'Type deleted successfully');
        $request->session()->flash('alert-class', 'alert alert-success');
        return redirect()->route('types.index');
    }
}
