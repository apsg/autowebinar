<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallToAction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_to_actions', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->text('description');

            $table->unsignedTinyInteger('delay')->default(60);
            $table->unsignedTinyInteger('duration')->default(60);

            $table->string('button_url')->nullable();
            $table->string('button_text')->nullable();

            $table->unsignedBigInteger('webinar_id');
            $table->foreign('webinar_id')
                ->references('id')
                ->on('webinars')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_to_actions');
    }
}
