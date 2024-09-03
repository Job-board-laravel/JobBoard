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
        Schema::table('applications', function (Blueprint $table) {
            //
            $table->foreignId('job_id')->constrained('newjobs','job_id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('candidate_id')->constrained('candidates', 'candidate_id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            //
            $table->dropForeign('applications_job_id_foreign');
            $table->dropColumn('job_id');
            $table->dropForeign('applications_candidate_id_foreign');
            $table->dropColumn('candidate_id');
        });
    }
};
