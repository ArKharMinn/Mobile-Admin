<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category_id', 'description', 'image', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
