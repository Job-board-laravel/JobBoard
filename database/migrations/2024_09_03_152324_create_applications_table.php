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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('application_id');
            $table->string('resume')->nullable();
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['Applied', 'Reviewed', 'Accepted', 'Rejected'])->default('Applied');
            $table->timestamp('applied_at')->useCurrent();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
