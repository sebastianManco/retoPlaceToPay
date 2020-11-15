<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pdf extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
