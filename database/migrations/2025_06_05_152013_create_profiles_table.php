<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('profiles', function (Blueprint $table) {
      $table->id();
      $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
      $table->uuid('national_id')->nullable();
      $table->string('avatar')->default('defaultavatar.png');
      $table->string('first_name', 25);
      $table->string('Middle_name', 25)->nullable();
      $table->string('rest_name', 150);
      $table->string('phone', 20)->nullable();
      $table->string('address', 255)->nullable();
      $table->string('city')->nullable();
      $table->string('state')->nullable();
      $table->string('country')->nullable();
      $table->date('dob')->nullable();
      $table->string('gender', 5)->nullable();
      $table->string('timezone')->default('Africa/Cairo');
      $table->string('local', 2)->default('en');
      $table->boolean('2fa')->default(0);
      $table->string('2fa_secret')->nullable();
      $table->timestampTz('last_login')->nullable();
      $table->timestampTz('password_changed')->nullable();
      $table->timestampsTz();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('profiles');
  }
};
