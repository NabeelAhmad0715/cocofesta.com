<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];

    public function images($imageType = 'featured')
    {
        return \App\ImageManager::whereIn('id', \App\Image::where('imageable_id', $this->id)->where('imageable_type', \App\Type::class)->where('image_type', $imageType)->pluck('image_manager_id'))->get();
    }

    public function imageDetach($imageType = 'header', $imageId = 0)
    {
        return Image::where(['imageable_id' => $this->id, 'imageable_type' => Type::class, 'image_type' => $imageType])->whereNotIn('image_manager_id', $imageId)->delete();
    }
    public function imageUpdate($imageType, $images)
    {
        foreach ($images as $image) {
            $imageRecord = Image::where(['imageable_id' => $this->id, 'imageable_type' => Type::class, 'image_type' => $imageType, 'image_manager_id' => $image])->first();
            if ($imageRecord == null) {
                $i = Image::create([
                    'image_manager_id' => intval($image),
                    'image_type' => $imageType,
                    'imageable_id' => $this->id,
                    'imageable_type' => Type::class,
                ]);
            }
        }
    }

    public function metaData()
    {
        return $this->hasMany(MetaData::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
