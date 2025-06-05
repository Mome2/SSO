<?php

namespace App\Repositories;

use App\Interfaces\resourcesInterface;
use App\Models\Permission;


class PermissionsRepo implements resourcesInterface
{
  /**
   * Create a new class instance.
   */
  public function __construct()
  {
    //
  }

  public function add(array $data): Permission
  {
    return Permission::create($data);
  }


  public function update(array $data): Permission
  {
    return Permission::update($data);
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


  public function getOne(int $id): Permission
  {
    return Permission::find($id);
  }


  public function getHiddenOne(int $id): Permission
  {
    return Permission::withTrashed()->find($id);
  }


  public function getWithQuery(string $query): Permission
  {
    return Permission::query($query);
  }


  public function getHiddenWithQuery(string $query): Permission
  {
    return Permission::withTrashed()->query($query);
  }


  public function getAll(): Permission
  {
    return Permission::all()->paginate();
  }


  public function getAllHidden(): Permission
  {
    return Permission::all()->withTrashed()->paginate();
  }
}
