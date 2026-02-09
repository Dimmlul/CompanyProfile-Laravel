<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // THREAD (CHAT)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('messages')
                  ->nullOnDelete();

            // SENDER
            $table->enum('sender', ['user', 'admin']);

            // USER (nullable untuk admin reply)
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // CONTENT
            $table->string('subject')->nullable();
            $table->text('message');

            // OPTIONAL
            $table->foreignId('order_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();


            // FILE
            $table->string('attachment')->nullable();
            $table->enum('attachment_type', ['image', 'file'])->nullable();

            // STATUS
            $table->boolean('is_read')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
