<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('IP');
            $table->string('secret');
        });

        Schema::create('broker_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('broker_id');
            $table->primary(['user_id','broker_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brokers');
        Schema::dropIfExists('broker_user');
    }
}
