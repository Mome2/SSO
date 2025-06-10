<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Role extends Model
{
  use SoftDeletes;

  protected $fillable = ['name', 'slug', 'description'];
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


  public function permissions()
  {
    return $this->belongsToMany(Permission::class);
  }

  public function users()
  {
    return $this->belongsToMany(User::class);
  }
}
