<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floors', function (Blueprint $table) {
            //$table->bigIncrements('id')->unsigned();
            $table->bigIncrements('id');        
            $table->string('name');
            //$table->timestamps();
        });
        //DB::update("ALTER TABLE floors AUTO_INCREMENT = 0");
        DB::statement("ALTER TABLE floors AUTO_INCREMENT = 10;");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floors');
    }
}
