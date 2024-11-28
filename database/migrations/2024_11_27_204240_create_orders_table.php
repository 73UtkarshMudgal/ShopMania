<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();  // Order ID
            $table->unsignedBigInteger('user_id');  // User ID (assuming users are logged in)
            $table->decimal('total_amount', 10, 2);  // Total price of the order
            $table->string('status')->default('pending');  // Order status (e.g., 'pending', 'completed')
            $table->string('payment_status')->default('unpaid');  // Payment status (e.g., 'paid', 'unpaid')
            $table->timestamps();  // Timestamps for created_at and updated_at
    
            // Foreign key constraint to link the order to the user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
