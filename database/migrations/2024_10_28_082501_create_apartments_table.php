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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('location_name');
            $table->string('apartment_name');
            $table->integer('total_floors')->nullable();
            $table->integer('total_units')->nullable();
            $table->string('address');
            $table->text('amenities')->nullable(); // E.g., Gym, Pool, Parking
            $table->string('status')->default('available'); // Available, Fully Occupied, Under Maintenance
            $table->json('images')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
