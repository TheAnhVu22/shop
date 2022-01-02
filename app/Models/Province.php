<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
     public $timestamps = false;
    protected $fillable=[
        'name_qh','type','matp'
    ];
    public $table='tbl_quanhuyen';
    public $primaryKey = 'maqh';
}
