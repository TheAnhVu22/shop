<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsToMany('App\Models\Product', 'product_id', 'id');
    }
}
