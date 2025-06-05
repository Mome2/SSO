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
    Schema::create('permissions', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug')->unique();
      $table->string('group', 50)->nullable();
      $table->string('description')->nullable();
      $table->timestampsTz();
      $table->softDeletesTz();
    });
    Schema::create('permission_role', function (Blueprint $table) {
      $table->foreignId('role_id')->constrained('roles');
      $table->foreignId('permission_id')->constrained('permissions');
      $table->primary(['role_id', 'permission_id']);
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('permissions');
    Schema::dropIfExists('permission_role');
  }
};
