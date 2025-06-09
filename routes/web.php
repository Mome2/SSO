<?php

use App\Http\Controllers\Authentication\showLoginController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->prefix('{service}/authentication/')->group(function () {
  Route::get('login/{handshaketoken}&{seesionid}&{callback}', [showLoginController::class, 'paly'])->name('login');
  /* Route::post('login/{handshaketoken}&{seesionid}&{callback}', 'processLoginController')->name('login');
  Route::get('register/{handshaketoken}&{seesionid}&{callback}', 'showRegisterController')->name('register');
  Route::post('register/{handshaketoken}&{seesionid}&{callback}', 'processRegisterController')->name('register');
  Route::get('forgot-password', 'showForgotPasswordController')->name('password.request');
  Route::post('forgot-password', 'processForgotPasswordController')->name('password.email');
  Route::get('reset-password/{token}', 'showResetPasswordController')->name('password.reset');
  Route::post('reset-password', 'processResetPasswordController')->name('password.update');*/
});
/* 
Route::middleware(['auth', 'verified', 'activeuser'])->namespace('App\Http\Controllers')->name()->prefix()->group(function () {
  require __DIR__ . '/app-routes.php';
  Route::middleware('')->namespace()->name()->prefix('profile')->group(function () {
    Route::get('/', 'ProfileController@show')->name('show');
    Route::get('/edit', 'ProfileController@edit')->name('edit');
    Route::put('/update', 'ProfileController@update')->name('update');
    Route::put('/update-avatar', 'ProfileController@updateAvatar')->name('update.avatar');
    Route::get('/security', 'ProfileController@security')->name('security');
    Route::put('/update-password', 'ProfileController@updatePassword')->name('update.password');
    Route::put('/update-2fa', 'ProfileController@update2FA')->name('update.2fa');
    Route::put('/update-personal', 'ProfileController@updatePersonal')->name('update.personal');
    Route::put('/update-contact', 'ProfileController@updateContact')->name('update.contact');
    Route::put('/update-location', 'ProfileController@updateLocation')->name('update.location');
    Route::put('/update-preferences', 'ProfileController@updatePreferences')->name('update.preferences');
  });
});
 */