<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable=[
        'name_xa','type','maqh'
    ];
    public $table='tbl_xaphuongthitran';
    public $primaryKey = 'xaid';
}
