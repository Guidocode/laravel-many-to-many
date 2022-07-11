<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    // creo collegamento con Category
    public function category(){
        return $this->belongsTo('App\Category');
    }

    // creo collegamento con Tag
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }


    // creo funzione statica che genera lo slug univoco
    public static function genereteSlug($title){

        $slug = Str::slug($title, '-');
        $base_slug = $slug;

        $take_slug = Post::where('slug', $slug)->first();

        $i = 1;
        while ($take_slug) {
            $slug = $base_slug . '-' . $i ;
            $i++;
            $take_slug = Post::where('slug', $slug)->first();
        }

        return $slug;
    }


    //fillable
    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'image',
        'description'
    ];
}
