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
        'name', 'description', 'price', 'active', 'stock'
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
     * Undocumented function
     *
     * @param string $query
     * @param string $search
     * @return
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
     * Undocumented function
     *
     * @param string $query
     * @return
     */
    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
