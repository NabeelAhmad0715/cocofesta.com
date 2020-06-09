<?php

namespace App;

use App\Image;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'parent_category', 'title', 'subtitle', 'slug', 'type_id', 'display_order', 'body', 'meta_title', 'meta_keywords', 'meta_description',
    ];


    /**
     * Get all of the categories's images.
     * @param string $imageType
     * @return
     */
    //    public function images()
    //    {
    //        return $this->morphMany(Image::class, 'imageable');
    //    }

    public function images($imageType = 'featured')
    {
        return \App\ImageManager::whereIn('id', \App\Image::where('imageable_id', $this->id)->where('imageable_type', \App\Category::class)->where('image_type', $imageType)->pluck('image_manager_id'))->get();
    }

    public function imageDetach($imageType = 'header', $imageId = 0)
    {
        return Image::where(['imageable_id' => $this->id, 'imageable_type' => Category::class, 'image_type' => $imageType])->whereNotIn('image_manager_id', $imageId)->delete();
    }
    public function imageUpdate($imageType, $images)
    {
        foreach ($images as $image) {
            $imageRecord = Image::where(['imageable_id' => $this->id, 'imageable_type' => Category::class, 'image_type' => $imageType, 'image_manager_id' => $image])->first();
            if ($imageRecord == null) {
                $i = Image::create([
                    'image_manager_id' => intval($image),
                    'image_type' => $imageType,
                    'imageable_id' => $this->id,
                    'imageable_type' => Category::class,
                ]);
            }
        }
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function parent()
    {
        return $this->belongsTo(\App\Category::class, 'parent_category');
    }

    public function children()
    {
        return $this->hasMany(\App\Category::class, 'parent_category');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
