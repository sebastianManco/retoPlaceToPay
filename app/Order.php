<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','status', 'total', 'reference'
    ];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function payment()
    {
        return $this->hasOne('App\Payment');
    }

    /**
     * @param $query
     * @param $dateFrom
     * @param $dateTo
     */
    public function scopeData($query, $dateFrom, $dateTo) {

        $query->whereBetween('created_at', [$dateFrom, $dateTo]);
    }
}
