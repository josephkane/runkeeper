<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('runs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("user_id")->unsigned();
            $table->foreign("user_id")->references("id")->on("users");
            $table->string('name');
            $table->string('description');
            $table->string('grain_bill');
            $table->integer('volume');
            $table->float('abv');
            $table->text('notes');
            $table->date('date');
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
        Schema::dropIfExists('runs');
    }
}
