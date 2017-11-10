<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OptionSeeder::class);
        $this->call(SemesterSeeder::class);
        $this->call(UserSeeder::class);
    }
}
