<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	    DB::table('categories')->insert(['name' => 'woonbegeleider','color' => 'orange']);
		DB::table('categories')->insert(['name' => 'zelf','color' => 'cyan']);
		DB::table('categories')->insert(['name' => 'familie_dagcentrum_begeleid','color' => 'green']);
		DB::table('categories')->insert(['name' => 'verpleging_thuishulp_poetshulp','color' => 'red']);
    }
}
