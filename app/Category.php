<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Category extends Model
{

    protected $fillable = [
        'id', 'name'
    ];

    public function product()
    {
        return $this->hasMany('App\Product'); 
    }

    public function getCachedCategories(): colletion
    {
        return Cache::remember(
            'categories', now()->addDay(), function() {
            return $this->all();
        });
    }
}
