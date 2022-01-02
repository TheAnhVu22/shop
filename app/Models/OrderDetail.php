<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_code', 'id');
    }
    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id', 'id');
    }
    public function coupon()
    {
        return $this->belongsTo('App\Models\Coupon', 'product_coupon', 'id');
    }
}
