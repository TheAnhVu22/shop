<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->hasMany('App\Models\Order', 'shipping_id', 'id');
    }
}
