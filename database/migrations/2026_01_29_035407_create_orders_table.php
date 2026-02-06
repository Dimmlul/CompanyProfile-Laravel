<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // USER
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            // CUSTOMER INFO
            $table->string('customer_email');

            // ORDER INFO
            $table->string('order_number')->unique();
            $table->integer('total');

            // PAYMENT
            $table->string('payment_status')->default('pending');
            $table->string('payment_token')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('midtrans_transaction_id')->nullable();
            $table->json('midtrans_response')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
