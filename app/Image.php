<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_manager_id', 'image_type', 'imageable_id', 'imageable_type', 'category_id'
    ];


    /**
     * Get the owning imageable model.
     */
    public function imageable()
    {
        return $this->morphTo();
    }

    public static function getHeaderImage($record)
    {

        $image = $record->images('header')->first();
        if (isset($image)) {
            $headerImage = $image;
        } else {
            $headerImage = null;
        }
        return $headerImage;
    }

    public static function getHeaderImagePivotTable($record)
    {
        $image = Image::where('id', $record->header_image)->first()->imageManager;
        if (isset($image)) {
            $headerImage = $image;
        } else {
            $headerImage = null;
        }
        return $headerImage;
    }

    public static function getBodyImage($record)
    {
        $image = $record->images('body')->first();
        if (isset($image)) {
            $bodyImage = $image->name;
        } else {
            $bodyImage = null;
        }
        return $bodyImage;
    }

    public static function getGalleryImages($record)
    {
        $images = $record->images('gallery');
        if (count($images) > 0) {
            $galleryImages = $images;
        } else {
            $galleryImages = null;
        }
        return $galleryImages;
    }

    public function imageManager()
    {
        return $this->belongsTo(ImageManager::class, 'image_manager_id');
    }
}
