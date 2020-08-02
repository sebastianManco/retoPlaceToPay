<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
       /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
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
