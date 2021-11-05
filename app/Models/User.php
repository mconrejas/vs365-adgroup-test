<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Models\Audit;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject, Auditable
{
    use Authenticatable, Authorizable, HasFactory, \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Set User Ip relationship
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function ips() 
    {
        return $this->hasMany(Ip::class);
    }

    /**
     * Set User Comment relationship
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function comments() 
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Manually create audit entry
     * 
     * @param String $type
     */
    public function audit(string $type)
    {
        Audit::create([
            'auditable_id'      => $this->id,
            'auditable_type'    => \App\Models\User::class,
            'event'             => $type,
            'url'               => request()->fullUrl(),
            'ip_address'        => request()->getClientIp(),
            'user_agent'        => request()->userAgent(),
            'user_type'         => \App\Models\User::class,
            'user_id'           => $this->id,
            'old_values'        => [],
            'new_values'        => $this,
        ]);
    }
}
