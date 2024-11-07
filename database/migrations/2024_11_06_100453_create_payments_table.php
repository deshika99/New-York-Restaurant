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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade'); 
            $table->decimal('total_amount', 8, 2)->default(0);  
            $table->decimal('paid_amount', 8, 2)->default(0);
            $table->decimal('due_amount', 8, 2)->default(0);      
            $table->string('payment_type'); 
            $table->date('payment_date');   
            $table->boolean('service_charge_applied')->default(0);
            $table->boolean('advance_payment')->default(0);
            $table->decimal('refundable_amount', 8, 2)->default(0);
            $table->string('refund_status')->nullable();
            $table->boolean('bank_transfer_confirmation')->default(0);
            $table->string('transfer_slip_image')->nullable();
            $table->decimal('discounted_total', 8, 2)->default(0);
            $table->boolean('partial_payment')->default(0);
            $table->string('payment_status')->nullable();     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
