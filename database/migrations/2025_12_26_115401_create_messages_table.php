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
    Schema::create('messages', function (Blueprint $table) {
        $table->id();

        $table->foreignId('from_id')->constrained('users')->cascadeOnDelete();
        $table->foreignId('to_id')->constrained('users')->cascadeOnDelete();
        $table->string('type')->default('text');
        $table->text('message')->nullable();
        $table->string('file_path')->nullable();
        $table->string('file_name')->nullable();
        $table->unsignedBigInteger('file_size')->nullable();
        $table->unsignedInteger('voice_duration')->nullable();
        $table->timestamp('read_at')->nullable();
        $table->timestamps();
        $table->index(['from_id', 'to_id', 'created_at']);
        $table->index(['to_id', 'read_at']);
        $table->index('type');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
