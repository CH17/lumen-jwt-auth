<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    
    protected $fillable = [
        'name', 'parent_id'
    ];

    public function parent(){
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function children(){
        return $this->hasMany('App\Category', 'parent_id');
    }

    
    // TODO: Find a better solution
    public function childs(){
    return $this->children()->with('childs');
    }


    public function products(){
        return $this->hasMany('App\Product', 'category_id');
    }


    protected static function boot() {
        parent::boot();
    
        static::deleting(function($category) { 
            $category->products()->delete();
        });
    }

}
