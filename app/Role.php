<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name', 'slug','description', 'full-access',
    ];


    //Relacion de muchos a muchos con la tabla Users
    public function users()
    {
        return $this->belongsToMany('App\User')->withTimesTamps();
    }
}
