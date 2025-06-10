<?php

namespace App\Enums;

enum ServiceStatus: string
{
  case development = 'development';
  case production = 'production';
  case disabled = 'disabled';
}
