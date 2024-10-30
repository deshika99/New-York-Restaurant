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
        Schema::create('floors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('apartment_id')->constrained('apartments')->onDelete('cascade');
            $table->integer('floor_number'); // E.g., Floor 1, Floor 2
            $table->integer('total_rooms')->nullable();
            $table->integer('occupied_rooms')->default(0);
            $table->string('floor_status')->default('available'); // Available, Partially Occupied, Fully Occupied
            $table->json('images')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('floors');
    }
};
