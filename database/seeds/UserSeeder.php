<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert(array(
            array('id'=>'1','email'=>'admin@example.com','password'=>'$2y$10$bgxJgQEgyZdWBVqZ5Z6xfOd7XeUohHAoh/FXqxpKRN1of9zQ0v0/W','role'=>'admin','created_at'=>Carbon::now(),'updated_at'=>Carbon::now())
        ));
    }
}
