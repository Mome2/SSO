<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Permission extends Model
{
  use SoftDeletes;

  /**
   * The attributes that are mass assignable.
   *
   * @var list<string>
   */
  protected $fillable = ['name', 'slug', 'group', 'description'];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var list<string>
   */
  protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

  private function slug(): Attribute
  {
    return Attribute::make(
      set: fn(string $value) => str($value)
        ->squish()
        ->lower()
        ->replaceMatches('/[^a-zA-Z0-9]+/', '_')
        ->replaceMatches('/[0-9]+/', '')
        ->trim('_')
    );
  }

  public function roles()
  {
    return $this->belongsToMany(Role::class);
  }
}
