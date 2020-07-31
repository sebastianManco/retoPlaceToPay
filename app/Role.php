<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug','description', 'full-access',
    ];

    /**
     * @return belongsToMany
     */
    public function users(): belongsToMany
    {
        return $this->belongsToMany('App\User')->withTimesTamps();
    }
}
