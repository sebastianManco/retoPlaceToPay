<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'description', 'image','price'
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
}
