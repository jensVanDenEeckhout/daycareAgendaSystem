<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TasksTableSeeder::class);
        $this->call(CellsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(FloorsTableSeeder::class);
        $this->call(EmployeesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);        
             
    }
}
