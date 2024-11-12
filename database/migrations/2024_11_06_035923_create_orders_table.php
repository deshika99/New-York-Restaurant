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
        $table->unsignedBigInteger('customer_id');
        $table->string('name');
        $table->string('email');
        $table->string('phone_number');
        $table->string('bookingType');
        $table->string('roomSelection');
        $table->date('startDate');
        $table->date('endDate');
        $table->string('paymentTerms');
        $table->string('paymentMethod');
        $table->decimal('discount', 5, 2)->nullable();
        $table->decimal('serviceCharge', 10, 2)->nullable();
        $table->timestamps();

        $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
