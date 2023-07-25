<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'two_factor_auth_type',
        'phone_number',
        'is_admin',
        'is_staff',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function activeCode()
    {
        return $this->hasMany(ActiveCode::class);
    }

    public function hasTwoFactor($key)
    {
        return $this->two_factor_auth_type == $key;
    }

    public function isTwoFactorAuthEnabled()
    {
        if($this->two_factor_auth_type !== 'Off')
        {
            return true;
        } else {
            return false;
        }
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function rules()
    {
        return $this->belongsToMany(Rule::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function hasRule($rules)
    {
        return (!! $rules->intersect($this->rules)->all());
    }

    public function hasPermission($permission)
    {
        return $this->hasRule($permission->rules) || $this->permissions->contains('name', $permission->name);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
