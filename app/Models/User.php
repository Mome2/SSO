<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\Active;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable, HasApiTokens, SoftDeletes, AuthMustVerifyEmail;

  public function scopeActive($query)
  {
    return (new Active)->apply($query, $this);
  }

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'email',
    'password',
    'status'
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'password',
    'remember_token',
    'email_verified_at',
    'created_at',
    'updated_at',
    'deleted_at'
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime: DD-MM-YYYY h:i:s',
      'created_at' => 'datetime: DD-MM-YYYY h:i:s',
      'updated_at' => 'datetime: DD-MM-YYYY h:i:s',
      'deleted_at' => 'datetime: DD-MM-YYYY h:i:s',
      'password' => 'hashed',
    ];
  }

  public function profile()
  {
    return $this->hasOne(Profile::class);
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }

  public function hasRole($role)
  {

    return $this->roles->pluck('slug')->contains(str($role)
      ->squish()
      ->lower()
      ->replaceMatches('/[^a-zA-Z0-9]+/', '_')
      ->replaceMatches('/[0-9]+/', '')
      ->trim('_'));
  }

  public function hasPermission($permission)
  {
    if ($this->hasRole('super_admin')) {
      return true;
    }

    foreach ($this->roles as $role) {
      if ($role->permissions->contains('slug', $permission)) {
        return true;
      }
    }

    return false;
  }
}
