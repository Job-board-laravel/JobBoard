<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsDeletedToApplicationsTable extends Migration
{
    public function up()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(0); // Add is_deleted column
        });
    }
    
    public function down()
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });
    }
}    