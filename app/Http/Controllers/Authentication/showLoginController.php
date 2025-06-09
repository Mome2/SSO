<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientLoginRequest;

class showLoginController extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function paly(ClientLoginRequest $request, $handshaketoken, $seesionid, $callback)
  {
    return 'login';
  }
}
