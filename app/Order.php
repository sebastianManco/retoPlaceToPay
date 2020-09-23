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
        'user_id','status', 'total'
    ];


    /**
     *
     *
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     *
     * @return belongsTo
     */
    public function user(): belongsTo
    {
        return $this->belongsTo('App\User');
    }


    public function paimen()
    {
        return $this->belongsTo('App\Paimen');
    }
}
