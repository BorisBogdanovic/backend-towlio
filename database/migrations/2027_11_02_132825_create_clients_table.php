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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('client_last_name');
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->string('licence_plate')->unique();
            $table->string('vin')->unique();
            $table->date('start_date');
            $table->date('expired_date');
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->year('production_year')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('status')->default(true);
             $table->foreignId('car_brand_id')
                ->constrained('car_brands')
                ->cascadeOnDelete();
            $table->foreignId('car_model_id')
                ->constrained('car_models')
                ->cascadeOnDelete();
            $table->foreignId('towlio_service_id')
                ->constrained('services')
                ->cascadeOnDelete();
            $table->foreignId('sales_person_id')
              ->nullable()
              ->constrained('users')
              ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
