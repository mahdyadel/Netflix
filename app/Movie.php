<?php

namespace App;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Movie extends Model
{

    protected $fillable = ['name' , 'description' , 'year' , 'path' , 'poster' , 'image' , 'rating' , 'percent'];

    protected $appends = ['poster_path', 'image_path'];
    
    //attributes ---------------------------------------
    public function getPosterPathAttribute()
    {
        return Storage::url('images/' . $this->poster);

    }// end of getPosterPathAttribute

    public function getImagePathAttribute()
    {
        return Storage::url('images/' . $this->image);

    }// end of getImagePathAttribute

     // scope ------------------------

     public function scopeWhenSearch($query , $search){

        return $query->when($search , function($q) use($search){

            return $q->where('name' , 'like' , "%$search%")
                    ->orWhere('description' , 'like' , "%$search%")
                    ->orWhere('year' , 'like' , "%$search%")
                    ->orWhere('rating' , 'like' , "%$search%");


        });
    }//en of scopewhensearch

    public function scopeWhenCategory($query  , $category){

        return $query->when($category , function($q) use($category){

            return $q->whereHas('categories' , function($qu) use($category){

                return $qu->whereIn('category_id' , (array)$category)

                        ->orWhereIn('name' , (array)$category);

            });
        });

    }//end of scopeWhenCategory

    ///////////Relations ---------------

    public function categories(){

        return $this->belongsToMany(Category::class , 'movie_category');

    }// end of categories
}//end of model
