<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageManager extends Model
{
    protected $fillable = [
        'name', 'credit', 'alt',
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'image_manager_id');
    }
}
