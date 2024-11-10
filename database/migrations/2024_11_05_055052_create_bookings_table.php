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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customer_registers')->onDelete('cascade'); 
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade'); 
            $table->date('booking_date');
            $table->date('start_date'); 
            $table->date('end_date');  
            $table->string('term');  
            $table->string('booking_type'); 
            $table->string('payment_type');
            $table->decimal('service_charge', 8, 2)->default(0)->nullable();  
            $table->decimal('total_cost', 10, 2); 
            $table->decimal('discount_applied', 8, 2)->default(0)->nullable();    
            $table->string('booking_status')->nullable();
            $table->string('confirmation_status')->nullable();  
            $table->timestamps();         
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
