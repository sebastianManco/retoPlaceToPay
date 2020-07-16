<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

 //relacion con productos
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
