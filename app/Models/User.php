<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use DateTimeInterface;
use App\Models\Permission;
use App\Models\AppConfiguration;
use App\Traits\HasMedias;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements JWTSubject
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
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    public function roles() : BelongsToMany
    {
      return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id')->withPivot(['is_active']);
    }

    public function permissions() : BelongsToMany
    {
      return $this->belongsToMany(Permission::class, 'permission_user', 'user_id', 'permission_id')->withPivot(['is_active']);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
      return $date->format(config('panel.datetime_format'));
    }

    public function computed_permissions() : Collection
    {
      if(AppConfiguration::getByCode(Permission::GRANT_PER_USER_CONF_CODE)?->value ?? false) 
      {
          $permissions = $this->permissions->wherePivot('is_active', true);
      }
      else
      {
          $permissions = Permission::whereHas('roles', function($role){

              $role->whereIn('id', $this->roles->pluck('id'))->where('is_active', true);

          })->get();
      }
      return $permissions;
    }
}
