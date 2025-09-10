<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactform extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'needs',
        'needs_other',
        'has_website',
        'existing_website',
        'website_likes',
        'website_dislikes',
        'webshop_products',
        'webshop_location',
        'description',
    ];
}
