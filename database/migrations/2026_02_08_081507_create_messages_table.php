<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
        $table->id();


        $table->foreignId('parent_id')->nullable()->constrained('messages')->nullOnDelete();

        $table->enum('sender', ['user', 'admin', 'client']);

        $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();

        $table->uuid('client_token')->nullable()->index();                          // guest token to make chat history dont expire/dissapear
        $table->string('client_name')->nullable();
        $table->string('client_email')->nullable();

        $table->string('subject')->nullable();
        $table->text('message')->nullable();

        $table->string('attachment')->nullable();
        $table->enum('attachment_type', ['image', 'file'])->nullable();

        $table->boolean('is_read')->default(false);

        $table->timestamps();
    });

    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
