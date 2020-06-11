<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::clas);
    }

    public function post()
    {
        return $this->belongsTo(Post::clas);
    }

    public function order()
    {
        return $this->belongsTo(Order::clas);
    }
}
