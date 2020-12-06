<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /**
     * @var string[]
     */
    protected $fillable = [
        'order_id',
        'requestId',
        'processUrl',
        'status',
        'created_ad',
        'internalReference'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'order_id');
    }
}
