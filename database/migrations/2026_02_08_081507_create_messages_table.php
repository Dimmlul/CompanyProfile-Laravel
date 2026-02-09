<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            // ========================
            // USER (AUTH ONLY)
            // ========================
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // ========================
            // MESSAGE
            // ========================
            $table->string('subject')->nullable();
            $table->text('message');

            // ========================
            // ADMIN REPLY (CHAT STYLE)
            // ========================
            $table->text('reply')->nullable();
            $table->timestamp('replied_at')->nullable();

            // ========================
            // OPTIONAL ORDER
            // ========================
            $table->foreignId('order_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            // ========================
            // STATUS
            // ========================
            $table->boolean('is_read')->default(false);

            $table->timestamps();

            $table->foreignId('parent_id')->nullable()->constrained('messages')->nullOnDelete();
$table->enum('sender', ['user', 'admin']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
