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
        Schema::table('rooms', function (Blueprint $table) {
            // Adding apartment_id field and setting it as a foreign key
            $table->foreignId('apartment_id')->after('id')->constrained('apartments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rooms', function (Blueprint $table) {
            // Dropping the foreign key and column
            $table->dropForeign(['apartment_id']);
            $table->dropColumn('apartment_id');
        });
    }
};
