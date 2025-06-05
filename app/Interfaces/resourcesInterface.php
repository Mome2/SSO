<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface resourcesInterface
{
  function add(array $data): Model;
  function update(array $data): Model;
  function hide(int $id): bool;
  function restore(int $id): bool;
  function delete(int $id): bool;
  function getOne(int $id): Model;
  function getHiddenOne(int $id): Model;
  function getWithQuery(string $query): Collection;
  function getHiddenWithQuery(string $query): Collection;
  function getAll(): Collection;
  function getAllHidden(): Collection;
}
