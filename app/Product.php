<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $fillable = [
        'description', 'image','price', 'active'
    ];

    //relacion con categorias
    public function category()
    {
        return $this->hasMany('App\Category');
   }

   //relacion con stock
   public function stock()
   {
    return $this->hasOne('App\Stock');
   }

  /**
     * @param Builder $query
     * @param string|null $description
     * @return Builder
     */
    public static function scopeDescription(Builder $query, ? string $description):Builder
    {
        if (null !== $description) {
            return $query->where('description', 'like', "%$description%");
        }
        return $query;
    }

    public function scopeActive($query) {
        return $query->where('active', 1);
    }

}
