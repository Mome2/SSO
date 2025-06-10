<?php

namespace App\Models;

use App\Models\Scopes\Active;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Service extends Model
{
  use SoftDeletes, HasApiTokens;



  public function isProduction()
  {
    return $this->status == 'production';
  }
}
