<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'status',
        'total',
        'reference'
    ];

    /**
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasOne
     */
    public function payment(): HasOne
    {
        return $this->hasOne('App\Payment');
    }

    /**
     * @param  $query
     * @param string $dateFrom
     * @param string $dateTo
     */
    public function scopeDateRange($query, $dateFrom, $dateTo)
    {

        $query->whereBetween('created_at', [$dateFrom, $dateTo]);
    }
}
