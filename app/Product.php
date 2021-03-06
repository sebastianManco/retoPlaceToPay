<?php

namespace App;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    public $allowedSorts = ['name'];
    public $type = 'products';
       /**
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'active',
        'stock',
        'created_at'
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
    public function fields(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category->name,
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
        return $this->belongsTo(Category::class);
    }

    /**
     *
     * @return hasMany
     */
    public function image(): hasMany
    {
        return $this->hasMany(Image::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    /**
     * @param $query
     * @param string $search
     * @return mixed
     */
    public function scopeName($query, $search)
    {
        if ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        }
    }

    /**
     * @param $query
     * @param string $search
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

    /**
     * @param string $category
     * @param string $search
     * @return LengthAwarePaginator
     */
    public function searchProducts($category, $search): LengthAwarePaginator
    {
        $query = Product::with(
            ['image' => function ($query) {
                $query->select('id', 'name', 'product_id');
            },
                'category' => function ($query) {
                    $query->select('id', 'name');
                }
            ]
        );
        switch ($category) {
            case 'name':
                $query->name($search);
                break;
            default:
                $query->category($search);
                break;
        }
        return $query->paginate(10, ['id','name']);
    }
}
