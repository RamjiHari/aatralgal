<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
     public function title()
    {
    	return $this->hasMany(Title::class);
    }
    public function posts()
    {
    	return $this->hasMany(Post::class);
    }
    public function deletecatimage(){
        if($this->image!='avtar1.jpeg'){
        Storage::delete('public/category/'.$this->image);
    }
    }
}
