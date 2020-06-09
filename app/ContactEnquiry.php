<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactEnquiry extends Model
{
    protected $guarded = ['g-recaptcha-response'];
}
