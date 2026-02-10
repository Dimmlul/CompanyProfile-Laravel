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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            $table->string('title');

            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();

            $table->string('location')->nullable();
            $table->timestamp('start_date');
            $table->timestamp('end_date')->nullable();

            $table->boolean('is_active')->default(true);
            
            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
