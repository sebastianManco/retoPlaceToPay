<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use phpDocumentor\Reflection\Types\Boolean;


class User extends Authenticatable implements MustVerifyEmail
{
    use  Notifiable;

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

    public function pdfs(): hasMany
    {
        return $this->hasMany('App\Pdf');
    }

    /**
     * @return belongsToMany
     */
    public function roles(): belongsToMany
    {
        return $this->belongsToMany('App\Role')->withTimesTamps();
    }

    /**
     * @param $roles
     * @return bool
     */
    public function authorizeRoles($roles): bool
    {
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'Esta acción no está autorizada.');
    }

    /**
     * @param $roles
     * @return bool
     */
    public function hasAnyRole($roles): bool
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
     * @param $role
     * @return bool
     */
    public function hasRole($role): bool
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
    }
}
