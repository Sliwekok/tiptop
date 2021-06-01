<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64);
            $table->string('species', 16);
            $table->string('status', 16);
            $table->string('phone', 16)->nullable();
            $table->string('place_name', 512);
            $table->decimal('lat', 18, 10);
            $table->decimal('lng', 18, 10);
            $table->date('accident_date');
            $table->time('accident_time');
            $table->string('description', 2048);
            $table->boolean('is_finish')->default(false);
            $table->string('finish_status', 255)->nullable();
            $table->string('finish_reason', 255)->nullable();
            $table->boolean('is_active');
            $table->boolean('notification')->nullable()->default(false);
            $table->timestamp('last_notification')->nullable();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('animals');
    }
}
