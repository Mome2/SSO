<?php

namespace App\Models;

use App\Enums\Gender;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = [
    'national_id',
    'avatar',
    'first_name',
    'Middle_name',
    'rest_name',
    'phone',
    'address',
    'city',
    'state',
    'country',
    'dob',
    'gender',
    'timezone',
    'local',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = [
    'user_id',
    '2fa_secret',
    'created_at',
    'updated_at',
  ];

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'gender' => Gender::class,
      'dob' => 'date: DD-MM-YYYY',
      'last_login' => 'datetime: DD-MM-YYYY h:i:s',
      'created_at' => 'datetime: DD-MM-YYYY h:i:s',
      'updated_at' => 'datetime: DD-MM-YYYY h:i:s',
      'password_changed' => 'datetime: DD-MM-YYYY h:i:s',
    ];
  }
  public function user()
  {
    return $this->belongsTo(User::class);
  }
}
