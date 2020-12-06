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
    use Notifiable;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'estado',
        'phone',
        'password'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return HasMany
     */
    public function orders(): hasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return HasMany
     */
    public function pdfs(): hasMany
    {
        return $this->hasMany(Pdf::class);
    }

    /**
     * @return belongsToMany
     */
    public function roles(): belongsToMany
    {
        return $this->belongsToMany(Role::class)->withTimesTamps();
    }

    /**
     * @param $roles
     * @return bool
     */
    public function authorizeRoles($roles): bool
    {
        return $this->hasAnyRole($roles);
    }

    /**
     * @param array| string $roles
     * @return bool
     */
    public function hasAnyRole($roles): bool
    {
        if (is_array($roles)) {
            $hasRoles = collect($roles)->filter(function ($item) {
                return $this->hasRole($item);
            })->count();

            if ($hasRoles) {
                return true;
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $role
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
