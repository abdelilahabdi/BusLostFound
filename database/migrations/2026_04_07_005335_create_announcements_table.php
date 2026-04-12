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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['lost', 'found']);
            $table->string('location');
            $table->string('bus_line')->nullable();
            $table->string('stop_name')->nullable();
            $table->date('event_date');
            $table->enum('status', ['active', 'resolved'])->default('active');
            $table->string('image_path')->nullable();
            $table->timestamps();

            $table->index(['type', 'status']);
            $table->index('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
