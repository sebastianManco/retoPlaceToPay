<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    protected $fillable = [
        'name'
    ];


 //relacion con productos
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
