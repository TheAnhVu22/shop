<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;
    public function city()
    {
        return $this->belongsTo('App\Models\City', 'thanhpho_id');
    }
    public function province()
    {
        return $this->belongsTo('App\Models\Province', 'quanhuyen_id');
    }
    public function wards()
    {
        return $this->belongsTo('App\Models\Wards', 'xa_id');
    }
    
}
