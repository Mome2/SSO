<?php

namespace App\Models;

use Illuminate\Auth\MustVerifyEmail as AuthMustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
  use Notifiable, HasApiTokens, SoftDeletes, AuthMustVerifyEmail;

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
      'email_verified_at' => 'datetime: DD-MM-YYYY H:i:s',
      'created_at' => 'datetime: DD-MM-YYYY H:i:s',
      'updated_at' => 'datetime: DD-MM-YYYY H:i:s',
      'deleted_at' => 'datetime: DD-MM-YYYY H:i:s',
      'password' => 'hashed',
    ];
  }

  public function profile()
  {
    return $this->hasOne(Profile::class);
  }
}
