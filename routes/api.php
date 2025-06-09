<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('')->namespace()->name()->prefix()->group(function () {
  Route::post('handshake');
});
