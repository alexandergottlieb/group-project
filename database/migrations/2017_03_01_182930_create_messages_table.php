<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
	       	
	        $table->string('content');
	        $table->boolean('read')->default(false);
	        $table->integer('from');
	        $table->integer('to');
	        
	        $table->integer('food_id');
	        
            $table->increments('id');
            $table->timestamps();
        });
        
        //Message <-> User pivot table
/*
        Schema::create('message_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('message_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
        });
*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::dropIfExists('message_user');
        Schema::dropIfExists('messages');
    }
}
