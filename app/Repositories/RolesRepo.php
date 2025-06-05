<?php

namespace App\Repositories;

use App\Interfaces\resourcesInterface;
use App\Models\Role;

class RolesRepo implements resourcesInterface
{
  /**
   * Create a new class instance.
   */
  public function __construct()
  {
    //
  }
  public function add(array $data): Role
  {
    return Role::create($data);
  }


  public function update(array $data): Role
  {
    return Role::update($data);
  }


  public function hide(int $id): bool
  {
    return true;
  }


  public function restore(int $id): bool
  {
    return true;
  }


  public function delete(int $id): bool
  {
    return true;
  }


  public function getOne(int $id): Role
  {
    return Role::find($id);
  }


  public function getHiddenOne(int $id): Role
  {
    return Role::withTrashed()->find($id);
  }


  public function getWithQuery(string $query): Role
  {
    return Role::query($query);
  }


  public function getHiddenWithQuery(string $query): Role
  {
    return Role::withTrashed()->query($query);
  }


  public function getAll(): Role
  {
    return Role::all()->paginate();
  }


  public function getAllHidden(): Role
  {
    return Role::all()->withTrashed()->paginate();
  }
}
