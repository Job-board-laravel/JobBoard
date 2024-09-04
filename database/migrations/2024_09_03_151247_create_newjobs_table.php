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
        Schema::create('newjobs', function (Blueprint $table) {
            $table->bigIncrements('job_id');
            $table->string('title');
            $table->text('description');
            $table->text('requirement');
            $table->text('benefit');
            $table->string('location');
            $table->string('contact_info')->nullable();
            $table->string('logo')->nullable();
            $table->string('technologies'); // Comma separated or JSON
            $table->enum('work_type', ['remote', 'onsite', 'hybrid']);
            $table->decimal('salary_range')->nullable();
            $table->date('application_deadline');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newjobs');
    }
};
