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
    Schema::create('services', function (Blueprint $table) {
      $table->id(); // Auto-incrementing primary key

      // The display name of the service (e.g., "My Awesome App")
      $table->string('name');

      // The domain where the service is hosted (e.g., "app.example.com")
      // This is used to validate redirect URLs and prevent phishing attacks
      $table->string('domain');

      // A unique identifier for the service, similar to OAuth client_id
      // This is used to identify which service is making requests
      // Example: "myapp-123456789"
      $table->string('client_id')->unique();

      // A secret key used to authenticate the service
      // This should be kept secure and never exposed to end users
      // Used to sign requests and validate service authenticity
      $table->string('client_secret');

      // Whether the service is active or not
      // Can be used to temporarily disable a service without deleting it
      $table->string('status')->default('development');

      $table->timestampsTz(); // created_at and updated_at timestamps with timezone
      $table->softDeletesTz(); // Soft deletes with timezone
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('services');
  }
};
