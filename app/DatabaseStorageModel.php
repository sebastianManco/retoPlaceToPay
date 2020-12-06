<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DatabaseStorageModel extends Model
{
    protected $table = 'cart_storage';

    /**
     * @var string[]
     */
    protected $fillable = [
        'id',
        'cart_data',
    ];

    /**
     * @param $value
     */
    public function setCartDataAttribute($value)
    {
        $this->attributes['cart_data'] = serialize($value);
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getCartDataAttribute($value)
    {
        return unserialize($value);
    }
}
