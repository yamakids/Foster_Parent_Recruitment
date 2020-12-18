<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Subscribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('subscribes', function (Blueprint $table) {
         $table->increments('id');
         $table->unsignedInteger('wish_id');
         $table->unsignedInteger('user_id');
         $table->integer('status');
         $table->text('message');
         $table->timestamps();

         $table->index('wish_id');
         $table->index('user_id');

         $table->foreign('wish_id')->references('id')->on('wishes');
         $table->foreign('user_id')->references('id')->on('users');
     });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('subscribes');
    }
}
