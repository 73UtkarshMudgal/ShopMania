<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        // Recreate the 'users' table
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID (primary key)
            $table->string('first_name');  // First name field (non-nullable)
            $table->string('last_name');   // Last name field (non-nullable)
            $table->string('email')->unique(); // Email (unique and non-nullable)
            $table->timestamp('email_verified_at')->nullable(); // Email verified at (nullable)
            $table->string('password'); // Password (non-nullable)
            $table->rememberToken(); // For "remember me" functionality
            $table->timestamps(); // created_at, updated_at timestamps

            // Additional fields that can be nullable
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('address')->nullable();
            $table->tinyInteger('is_admin')->default(0); // Default value for admin status
            $table->string('phone')->nullable(); // Phone field (nullable)
            $table->string('address_line2')->nullable(); // Address line 2 (nullable)
            $table->string('zip')->nullable(); // Zip code (nullable)
            $table->tinyInteger('terms')->default(0); // Default is false (0)
        });

        // Recreate the 'password_reset_tokens' table
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Recreate the 'sessions' table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
