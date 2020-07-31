<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{

    protected $fillable = [
        'name', 'product_id'
    ];

   
    /**
     * Undocumented function
     *
     * @return belongsTo
     */
    public function product(): belongsTo
    {
        return $this->belongsTo('App\Product');
   }
}
