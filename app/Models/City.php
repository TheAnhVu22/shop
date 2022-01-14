<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
     public $timestamps = false;
    protected $fillable=[
        'name_tp','type'
    ];
    public $table='tbl_tinhthanhpho';
    public $primaryKey = 'matp';
    public function province()
    {
        return $this->hasMany('App\Models\Province', 'matp');
    }
}
