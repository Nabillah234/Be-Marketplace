<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = [
        'product_name',
        'product_type_id',
        'description',
        'stock',
        'price',
        'img_url',
        'img_name'
    ];
}
