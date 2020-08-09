<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WebinarAddVisualOptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('webinars', function (Blueprint $table) {
            $table->string('slug')->nullable();
            $table->string('background')->nullable();
            $table->string('presenter_url')->nullable();
            $table->text('presenter_description')->nullable();
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
            $table->dropColumn('slug');
            $table->dropColumn('background');
            $table->dropColumn('presenter_url');
            $table->dropColumn('presenter_description');
        });
    }
}
