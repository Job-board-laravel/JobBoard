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
        Schema::table('newjobs', function (Blueprint $table) {
            //
            $table->enum('stutas', ['Approve', 'Reject', 'Pending'])->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newjobs', function (Blueprint $table) {
            //
            $table->dropColumn('stutas');

        });
    }
};
