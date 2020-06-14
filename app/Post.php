<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public $timestamps = true;

    protected $fillable = ['type_id', 'title', 'slug', 'in_stock', 'created_at', 'updated_at'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }

    public function metaData()
    {
        return $this->belongsToMany(MetaData::class)->withPivot('value');
    }

    public function metaDataPost()
    {
        return $this->hasMany(MetaDataPost::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }


    public function getMetaData($text)
    {
        if ($text) {
            foreach ($this->metaData as $postValue) {
                if ($postValue->name == $text) {
                    if ($postValue->field_type == 'file' && $postValue->multiple == 1 && $postValue->pivot->value != null) {
                        $files = explode(',', $postValue->pivot->value);
                    } else {
                        return $postValue->pivot->value;
                    }
                }
            }
            if (isset($files)) {
                return $files;
            } else {
                return null;
            }
        }
    }
}
