<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	
        //
		//DB::table('employees')->insert(['name' => 'Werknemers','note' => 'Werknemers','attendance' => '0']);        
		DB::table('employees')->insert(['name' => 'Carmen Van den Bossche','note' => 'Carmen Van den Bossche','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Eline Claessens','note' => 'Eline Claessens','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Alison Dupré','note' => 'Alison Dupré','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Glenn Van der Vekens','note' => 'Glenn Van der Vekens','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Frederik Boucquez','note' => 'Frederik Boucquez','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Audrey Maeck','note' => 'Audrey Maeck','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Ann Baudery','note' => 'Ann Baudery','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Femke De Ridder','note' => 'Femke De Ridder','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Debby De Croes','note' => 'Debby De Croes','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Leen de Raes','note' => 'Leen de Raes','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Jonathan Blondeel','note' => 'Jonathan Blondeel','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Lindsay Kindermans','note' => 'Lindsay Kindermans','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Mano Toté','note' => 'Mano Toté','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Kathy Van Spitael','note' => 'Kathy Van Spitael','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Marie Gousseau','note' => 'Marie Gousseau','attendance' => '0']);
		DB::table('employees')->insert(['name' => 'Lies Vercauteren','note' => 'Lies Vercauteren','attendance' => '0']);
    }
}
