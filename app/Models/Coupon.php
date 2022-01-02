<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    public function orderdetail()
    {
        return $this->hasMany('App\Models\OrderDetail', 'product_coupon');
    }
}
