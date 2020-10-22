<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
       /**
     *
     * @var array
     */
    protected $fillable = [
        'category_id','name', 'description', 'price', 'active', 'stock'
    ];

    /**
    *
    * @return belongsTo
    */
    public function category(): belongsTo
    {
        return $this->belongsTo('App\Category');
    }

    /**
     *
     * @return hasMany
     */
    public function image(): hasMany
    {
        return $this->hasMany('App\Image');
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     *
     * @param string $query
     * @param string $search
     * @return
     */
    public function scopeName($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
    }

    /**
     * @param $query
     * @param $search
     */
    public function scopeCategory($query, $search)
    {
        if (empty($search)) {
            return;
        }
        return $query->whereHas('category', function ($query) use ($search) {
            $query->where('name', 'LIKE', "%$search%");
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
   public function scopeStock($query)
    {
        return $query->where('stock', '>', 0);
    }

}
