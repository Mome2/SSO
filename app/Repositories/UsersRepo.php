<?php

namespace App\Repositories;

use App\Interfaces\resourcesInterface;
use App\Models\User;


class UsersRepo implements resourcesInterface
{
  /**
   * Create a new class instance.
   */
  public function __construct()
  {
    //
  }


  public function add(array $data): User
  {
    return User::create($data);
  }


  public function update(array $data): User
  {
    return User::update($data);
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


  public function getOne(int $id): User
  {
    return User::find($id);
  }


  public function getHiddenOne(int $id): User
  {
    return User::withTrashed()->find($id);
  }


  public function getWithQuery(string $query): User
  {
    return User::query($query);
  }


  public function getHiddenWithQuery(string $query): User
  {
    return User::withTrashed()->query($query);
  }


  public function getAll(): User
  {
    return User::all()->paginate();
  }


  public function getAllHidden(): User
  {
    return User::all()->withTrashed()->paginate();
  }
}
