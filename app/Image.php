<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
   /**
     * @var array
     */
    protected $fillable = [
        'name', 'product_id'
    ];

    /**
     * @return belongTo
     */
    public function product(): belongTo
    {
        return $this->belongsTo('App\Product');
   }
}
