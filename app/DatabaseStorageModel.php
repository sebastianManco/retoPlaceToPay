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
     * @return void
     */
    public function setCartDataAttribute($value): void
    {
        $this->attributes['cart_data'] = serialize($value);
    }


    public function getCartDataAttribute($value)
    {
        return unserialize($value);
    }
}
