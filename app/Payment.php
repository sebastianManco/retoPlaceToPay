<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id', 'requestId','processUrl', 'status'//aqui tambien nombre la referencia
    ];


    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
