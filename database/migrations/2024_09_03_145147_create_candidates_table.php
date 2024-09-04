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
    Schema::create('candidates', function (Blueprint $table) {
        $table->bigIncrements('candidate_id');
        // $table->string('resume')->nullable();
        $table->text('profile_summary')->nullable();
        $table->text('experience')->nullable();
        // $table->text('skills')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
