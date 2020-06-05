<?php

namespace App;
use App\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
   
    protected $fillable = [
        'title', 'content', 'description','image','category_id'
    ];
    public function user(){

    }
    public function category(){
       return $this->belongsTo(Category::class,'category_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class)->withTimestamps();
     }
     public function hasTag($tagId){
       // return $this->tags()->whereTagId($tagId)->exists();
        return in_array($tagId,$this->tags->pluck('id')->toArray());
     }
     public function hasCategory($categoryId){
        return $this->whereCategoryId($categoryId)->exists();
     }
     
}
