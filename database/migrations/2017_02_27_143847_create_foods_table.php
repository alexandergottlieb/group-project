<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
	        
	        $table->softDeletes(); //https://laravel.com/docs/5.4/eloquent#soft-deleting
	        
	        $table->string('name');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('best_before')->nullable();
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
	        $table->string('category');
	        
	        $table->integer('user_id');
	        
            $table->increments('id');
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
        Schema::dropIfExists('foods');
    }
}
