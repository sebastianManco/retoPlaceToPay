<?php

namespace App;

use App\Events\customReportsEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    public  $allowedSorts = ['name'];
    public $type = 'products';
       /**
     *
     * @var array
     */
    protected $fillable = [
        'category_id','name', 'description', 'price', 'active', 'stock', 'created_at'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id' => 'string',
        'stock' => 'string',
        'price' => 'string'
        ];

    /**
     * @return array
     */
    public function attributes() {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'price' =>  $this->price,
            'stock' => $this->stock
        ];

    }

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

    public function orders()
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

    public function scopeApplySorts(Builder $query, $sort)
    {
        $sortFields = Str::of($sort)->explode(',');

        foreach ($sortFields as $sortField)
        {
            $direction = 'asc';

            if(Str::of($sortField)->startsWith('-')) {
                $direction = 'des';
                $sortField = Str::of($sortField)->substr(1);

            }
        $query->orderBy($sortField, $direction)->reorder();
        }
    }

}
