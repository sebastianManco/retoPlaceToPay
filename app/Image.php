<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
   /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
