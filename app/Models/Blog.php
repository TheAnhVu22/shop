<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    public function categoryblog()
    {
        return $this->belongsTo('App\Models\CategoryBlog', 'cate_blog_id', 'id');
    }
}
