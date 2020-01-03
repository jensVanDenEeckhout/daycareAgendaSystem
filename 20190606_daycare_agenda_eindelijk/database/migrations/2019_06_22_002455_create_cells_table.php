<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->bigIncrements('id');
            /*
            $table->string('value');
            $table->dateTime('time');
            */
            //$table->string('x');
            $table->string('y');
            $table->integer('task_id');            
            $table->integer('table_id');
            $table->dateTime('time');
            $table->integer('client_id');
            $table->integer('floor_id');
            $table->integer('category_id');
            $table->integer('task_done');


                        
            //$table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cells');
    }
}
