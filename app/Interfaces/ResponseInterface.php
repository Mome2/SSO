<?php

namespace App\Interfaces;

interface ResponseInterface
{
  function status();
  function message();
  function resource();
  function resourcepermissions();
  function exceptions();
  function response();
}
