<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }
}
