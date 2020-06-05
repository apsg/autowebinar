<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WebinarAddDescription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->text('description');
            $table->unsignedInteger('length')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('length');
        });
    }
}
