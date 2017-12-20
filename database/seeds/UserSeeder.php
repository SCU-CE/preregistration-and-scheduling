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
            array('id'=>'1','email'=>env('ADMIN_EMAIL', 'admin@example.com'),'password'=>bcrypt(env('ADMIN_PASSWORD', 'admin@example.com')),'role'=>'admin','created_at'=>Carbon::now(),'updated_at'=>Carbon::now())
        ));
    }
}
