<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Movie;


class Category extends Model
{
    protected $fillable = ['name'];


    public function getNameAttribute($value){

        return ucfirst($value);
    }

    // scope ------------------------

    public function scopeWhenSearch($query , $search){

        return $query->when($search , function($q) use($search){

            return $q->where('name' , 'like' , "%$search%");

        });
    }//en of scopewhensearch

    /////////Relations ----------

    public function movies(){

        return $this->belongsToMany(Movie::class , 'movie_category');

    }//end of movies
}
