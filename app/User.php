<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'last_name','email', 'estado','phone', 'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(): hasMany
    {
        return $this->hasMany('App\Order');
    }

    /**
     * @return belongsToMany
     */
    public function roles(): belongsToMany
    {
        return $this->belongsToMany('App\Role')->withTimesTamps();
    }

    /**
     * @return boolean
     */
    public function authorizeRoles($roles)
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    /**
     *@return boolean
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

/**
 *@return boolean
 */
    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
