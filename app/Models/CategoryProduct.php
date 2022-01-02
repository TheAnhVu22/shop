<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_name','category_slug','category_status','category_desc'
    ];
    public function product()
    {
        return $this->hasMany('App\Models\Product','category_id','id');
    }
}
