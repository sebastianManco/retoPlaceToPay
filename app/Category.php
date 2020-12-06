<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $type = 'categories';

    protected $fillable = [
        'id', 'name'
    ];


    /**
     * @var string[]
     */
    protected $casts = [
        'id' => 'string',
    ];

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'name' => $this->name
        ];
    }

    /**
     * Undocumented function
     *
     * @return hasMany
     */
    public function product(): hasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return mixed
     */
    public function getCachedCategories()
    {
        return Cache::remember(
            'categories',
            now()
            ->addDay(),
            function () {
                return $this->all();
            }
        );
    }

    /**
     * @return void
     */
    public static function flushCache(): void
    {
        Cache::forget('categories');
    }
}
