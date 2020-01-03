<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('medische informatie');
            $table->longText('medicatielijst');
            $table->longText('nummers');            
            $table->longText('begeleidingsinfo');            
            $table->longText('begeleidingstaken');            
            $table->string('rijksregisternummer');            
            $table->string('gsm');            
            $table->string('adres');            
            $table->string('picture');
            $table->integer('floor_id');




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
        Schema::dropIfExists('clients');
    }
}
