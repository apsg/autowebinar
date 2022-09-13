<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('user_webinar', function (Blueprint $table) {
            $table->timestamp('subscribed_at')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('user_webinar', function (Blueprint $table) {
            $table->dropColumn('subscribed_at');
            $table->dropColumn('started_at');
            $table->dropColumn('finished_at');
        });
    }
};
