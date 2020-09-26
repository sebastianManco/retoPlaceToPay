<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paimen extends Model
{
    protected $fillable = [
        'order_id', 'requestId','processUrl', 'status'//aqui tambien nombre la referencia
    ];


    public function order()
    {
        return $this->hasOne('App\Order');
    }
}
