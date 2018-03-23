<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jars', function (Blueprint $table) {
                    $table->increments('id');
                    $table->integer("run_id")->unsigned();
                    $table->foreign("run_id")->references("id")->on("runs");
                    $table->integer('number');
                    $table->time('time_started');
                    $table->integer('proof_start');
                    $table->integer('column_temp_start');
                    $table->integer('proof_end');
                    $table->integer('column_temp_end');
                    $table->integer('volume');
                    $table->tinyInteger('favorite');
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
        Schema::dropIfExists('jars');
    }
}
