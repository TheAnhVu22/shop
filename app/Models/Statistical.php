<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;
    public $timestamps=false;
    protected $fillable=[
        'id_statistical','order_date','sales','profit','quantity','total_order'
    ];
    public $table='tbl_statistical';
    public $primaryKey='id_statistical';
}
