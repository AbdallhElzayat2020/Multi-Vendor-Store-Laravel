<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete(); // user order
            $table->foreignId('store_id')->constrained('stores')->cascadeOnDelete(); // store order
            $table->string('number')->unique();
            $table->enum('status', ['pending', 'processing', 'completed', 'declined'])->default('pending');
            $table->unsignedSmallInteger('quantity')->default(1);
            $table->enum('payment_status', ['pending', 'completed', 'declined', 'refunded', 'cancelled'])->default('pending');
            $table->string('payment_method');
            $table->timestamps();
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
