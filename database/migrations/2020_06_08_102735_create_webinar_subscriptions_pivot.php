<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebinarSubscriptionsPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_webinar', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('webinar_id');
            $table->foreign('webinar_id')
                ->references('id')
                ->on('webinars')
                ->onDelete('cascade');

            $table->index(['user_id', 'webinar_id']);
            $table->unique(['user_id', 'webinar_id']);

            $table->timestamp('email_sent_at')
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_webinar');
    }
}
