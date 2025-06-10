<?php

use App\Http\Controllers\Authentication\showLoginController;
use App\Http\Controllers\Authentication\processLoginController;
use App\Http\Controllers\Authentication\showForgotPasswordController;
use App\Http\Controllers\Authentication\processForgotPasswordController;
use App\Http\Controllers\Authentication\processlogoutController;
use App\Http\Controllers\Authentication\showResetPasswordController;
use App\Http\Controllers\Authentication\processResetPasswordController;
use App\Http\Controllers\Authentication\showRegisterController;
use App\Http\Controllers\Authentication\processRegisterController;
use App\Http\Controllers\Authentication\processVerificationRequestController;
use App\Http\Controllers\Authentication\showVerificationController;
use App\Http\Controllers\Authentication\showVerificationNoticeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//login view
//register view
//forgot password view
//reset password view
//service validation view
//service redirect view
//verifing email view
//request verification view
//profile view
//errors view
Route::get('/', function () {
  return view('welcome');
});

// Service Authentication Routes
Route::middleware('guest')->prefix('{service}/authentication/')->group(function () {
  // Login Flow
  Route::get('login/{handshaketoken}&{sessionid}&{callback}', showLoginController::class)
    ->name('login');
  Route::post('login/{handshaketoken}&{sessionid}&{callback}', processLoginController::class);

  // Forgot Password Flow 
  Route::get('forgot-password', showForgotPasswordController::class)
    ->name('password.request');
  Route::post('forgot-password', processForgotPasswordController::class)
    ->name('password.email');
  Route::get('reset-password/{token}', showResetPasswordController::class)
    ->name('password.reset');
  Route::post('reset-password', processResetPasswordController::class)
    ->name('password.update');

  // Register Flow
  Route::get('register/{handshaketoken}&{sessionid}&{callback}', showRegisterController::class)
    ->name('register');
  Route::post('register/{handshaketoken}&{sessionid}&{callback}', processRegisterController::class);
});

// Protected Routes (after authentication)
Route::middleware('auth')->group(function () {

  // Email Verification Routes
  Route::get('/email/verify', showVerificationNoticeController::class)->name('verification.notice');
  Route::get('/email/verify/{id}/{hash}', showVerificationController::class)->name('verification.verify');
  Route::post('/email/resend', processVerificationRequestController::class)->name('verification.resend');

  //logout
  Route::post('/logout', processlogoutController::class)->name('logout');

  Route::middleware(['verified', 'active.user'])->group(function () {

    // Profile Management Routes
    // All routes under /profile will be prefixed with 'profile.' in their names
    // Example: profile.personal.show, profile.security.update, etc.
    Route::prefix('profile/{profile}')->name('profile.')->group(function () {
      // Main Profile Dashboard
      // URL: /profile
      // Shows overview of all profile sections
      Route::get('/', 'ProfileController@show')->name('show');

      // Personal Information Section
      // URL: /profile/personal
      // Handles basic personal details like name, avatar, etc.
      Route::prefix('personal')->name('personal.')->group(function () {
        // Show personal information form
        // URL: /profile/personal
        Route::get('/', 'ProfileController@personal')->name('show');

        // Update personal information
        // URL: /profile/personal/update
        // Method: PUT
        Route::put('/update', 'ProfileController@updatePersonal')->name('update');

        // Update profile picture
        // URL: /profile/personal/avatar
        // Method: PUT
        Route::put('/avatar', 'ProfileController@updateAvatar')->name('avatar');
      });

      // Contact Information Section
      // URL: /profile/contact
      // Handles phone and address information
      Route::prefix('contact')->name('contact.')->group(function () {
        // Show contact information form
        // URL: /profile/contact
        Route::get('/', 'ProfileController@contact')->name('show');

        // Update contact information
        // URL: /profile/contact/update
        // Method: PUT
        Route::put('/update', 'ProfileController@updateContact')->name('update');
      });

      // Location Information Section
      // URL: /profile/location
      // Handles city, state, and country information
      Route::prefix('location')->name('location.')->group(function () {
        // Show location information form
        // URL: /profile/location
        Route::get('/', 'ProfileController@location')->name('show');

        // Update location information
        // URL: /profile/location/update
        // Method: PUT
        Route::put('/update', 'ProfileController@updateLocation')->name('update');
      });

      // Security Settings Section
      // URL: /profile/security
      // Handles password, 2FA, and national ID
      Route::prefix('security')->name('security.')->group(function () {
        // Show security settings page
        // URL: /profile/security
        Route::get('/', 'ProfileController@security')->name('show');

        // Update password
        // URL: /profile/security/password
        // Method: PUT
        Route::put('/password', 'ProfileController@updatePassword')->name('password');

        // Enable/disable 2FA
        // URL: /profile/security/2fa
        // Method: PUT
        Route::put('/2fa', 'ProfileController@update2FA')->name('2fa');

        // Update national ID
        // URL: /profile/security/national-id
        // Method: PUT
        Route::put('/national-id', 'ProfileController@updateNationalId')->name('national-id');
      });

      // User Preferences Section
      // URL: /profile/preferences
      // Handles timezone and language settings
      Route::prefix('preferences')->name('preferences.')->group(function () {
        // Show preferences page
        // URL: /profile/preferences
        Route::get('/', 'ProfileController@preferences')->name('show');

        // Update timezone
        // URL: /profile/preferences/timezone
        // Method: PUT
        Route::put('/timezone', 'ProfileController@updateTimezone')->name('timezone');

        // Update language
        // URL: /profile/preferences/locale
        // Method: PUT
        Route::put('/locale', 'ProfileController@updateLocale')->name('locale');
      });

      // Activity Log Section
      // URL: /profile/activity
      // Shows user's activity history
      Route::prefix('activity')->name('activity.')->group(function () {
        // Show main activity page
        // URL: /profile/activity
        Route::get('/', 'ProfileController@activity')->name('show');

        // Show login history
        // URL: /profile/activity/logins
        Route::get('/logins', 'ProfileController@loginHistory')->name('logins');

        // Show password change history
        // URL: /profile/activity/password-changes
        Route::get('/password-changes', 'ProfileController@passwordHistory')->name('password-changes');
      });
    });
  });
});
