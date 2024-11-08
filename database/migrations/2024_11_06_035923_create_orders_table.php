<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('bookingType');
            $table->string('roomSelection');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('paymentTerms');
            $table->string('paymentMethod');
            $table->decimal('discount', 8, 2)->nullable();
            $table->decimal('serviceCharge', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
