<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Image;
use App\ImageManager;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ImagesController extends Controller
{

    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required | image',
        ]);
        if (!$validator->passes()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $image = $request->file('image');
        $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = $name . '_' . Str::random(3) . '.' . $image->getClientOriginalExtension();
        $i = ImageManager::create([
            'name' => $filename,
            'alt' => $request->alt,
            'credit' => $request->credit,
        ]);
        Storage::putFileAs('public', $image, $filename);
        return response()->json([
            'message' => 'Image Upload Successfully',
            'src' => $filename,
            'imageId' => $i->id,
            'imageName' => $i->name,
            'imageAlt' => $i->alt,
            'class_name' => 'alert-success'
        ]);
    }

    public function delete(Request $request)
    {
        $image = ImageManager::where('id', $request->id)->first();
        $fileName = $request->name;
        Storage::delete('public/' . $fileName);
        $image->delete();
        $images = ImageManager::orderBy('id', 'desc')->get();
        return response()->json($images);
    }

    function fetchData(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $selection = json_decode(request("selection"));
            $data = ImageManager::where('alt', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(20);
            $data = view('admin.partials.paginated-image', compact(['data', 'selection']))->render();
            echo json_encode($data);
        }
    }

    function selectedImage(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->get('data');
            $string = json_decode($data);
            $data = json_decode($string, false);
            $imageableType = $request->get('imageableType');
            $imageableId = $request->get('imageableId');
            $imageType = $request->get('imageType');
            $data = view('admin.partials.selected-image', compact(['data', 'imageableType', 'imageableId', 'imageType']))->render();
            echo json_encode($data);
        }
    }

    function deselectImage(Request $request)
    {
        if ($request->ajax()) {
            $imageId = $request->get('imageId');
            $imageableType = $request->get('imageableType');
            $imageableId = $request->get('imageableId');
            $imageType = $request->get('imageType');
            Image::where(['imageable_id' => $imageableId, 'imageable_type' => $imageableType, 'image_type' => $imageType, 'image_manager_id' => $imageId])->delete();
            return response()->json([
                'message'   => 'Image deselected successfully',
                'className'  => 'alert-success'
            ]);
        }
    }
}
