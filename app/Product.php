<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'price', 'active', 'stock'
    ];

     /**
    * 
    */
    public function category()
    {
        return $this->belongsTo('App\Category');
   }


   public function image()
   {
       return $this->hasMany('App\Image'); 
   }

  /**
     * @param Builder $query
     * @param string|null $name
     * @return Builder
     */
    /*public static function scopeName(Builder $query, ? string $name):Builder
    {
        if (null !== $name) {
            return $query->where('name', 'like', "%$name%");
        }
        return $query;
    }*/
    public function scopeBuscarpor($query, $tipo, $buscar) {
        if (($tipo) && ($buscar)) {
            return $query->where($tipo, 'LIKE', "%$buscar%");
        }
    }

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

}
