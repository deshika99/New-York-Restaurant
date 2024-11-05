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
    Schema::table('users', function (Blueprint $table) {
        $table->string('phone_number')->nullable()->after('password');
        $table->string('whatsapp_number')->nullable()->after('phone_number');
        $table->text('note')->nullable()->after('whatsapp_number');
        
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['phone_number', 'whatsapp_number', 'note']);
    });
}

};
