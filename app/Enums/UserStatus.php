<?php

namespace App\Enums;

enum UserStatus: string
{
  case ACTIVE = 'active';
  case INACTIVE = 'inactive';
  case PENDING = 'pending';
  case BLOCKED = 'blocked';
  case DELETED = 'deleted';
  case SUSPENDED = 'suspended';
}
