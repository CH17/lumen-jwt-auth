<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    
    protected $fillable = [
        'name', 'description'
    ];

    
    public function category()
    {
        return $this->belongsTo('App\Product', 'category_id');
    }
}
