<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->unsignedBigInteger('promotion_id')->nullable()->after('discount_applied');
        $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('set null');
    });

    Schema::table('payments', function (Blueprint $table) {
        $table->decimal('promotion_amount', 10, 2)->nullable()->after('discounted_total');
    });
} 

public function down()
{
    Schema::table('bookings', function (Blueprint $table) {
        $table->dropForeign(['promotion_id']);
        $table->dropColumn('promotion_id');
    });

    Schema::table('payments', function (Blueprint $table) {
        $table->dropColumn('promotion_amount');
    });
}
};
