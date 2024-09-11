<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeletedToApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->softDeletes(); // This adds a nullable deleted_at TIMESTAMP column

        });
    }

    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropSoftDeletes(); // This removes the deleted_at column
        });
    }
}
