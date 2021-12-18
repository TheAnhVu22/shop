<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function category()
    {
        return $this->belongsTo('App\Models\CategoryProduct','category_id','id');    
    }
    public function brand()
    {
        return $this->belongsTo('App\Models\BrandProduct','brand_id','id');    
    }
}
