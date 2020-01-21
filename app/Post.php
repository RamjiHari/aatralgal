<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
class Post extends Model
{
	use SoftDeletes;
	public function deleteimage(){
        if($this->image!='avtar1.jpeg'){
        Storage::delete('public/posts/'.$this->image);
    }
    }
     public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    public function title()
    {
    	return $this->belongsTo(Title::class);
    }
      public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function hastags($tagId)
    {
        return  in_array($tagId,$this->tags->pluck('id')->toArray());
    }
}
