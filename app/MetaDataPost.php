<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetaDataPost extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $table = "meta_data_post";
}
