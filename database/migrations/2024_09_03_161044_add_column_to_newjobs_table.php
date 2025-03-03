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
            $table->foreignId('user_id')->constrained('users','user_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->constrained('categories','category_id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('newjobs', function (Blueprint $table) {
            //
            $table->dropForeign('newjobs_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('newjobs_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
};
