<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Tag;
use App\User;

class Tag extends Model
{
    protected $fillable=['name']; 
    public function posts(){
        return $this->belongsToMany(Post::class);
     }
}