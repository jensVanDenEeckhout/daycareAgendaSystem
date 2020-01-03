<?php

use Illuminate\Database\Seeder;

class FloorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('floors')->insert(['name' => 'gelijk']);   
        DB::table('floors')->insert(['name' => 'eerste']);
        DB::table('floors')->insert(['name' => 'tweede']);
        DB::table('floors')->insert(['name' => 'molenberg']);
        //DB::table('floors')->insert(['name' => '']);              
    }
}
