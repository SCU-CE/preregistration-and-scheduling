<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SemesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('semesters')->delete();
        DB::table('semesters')->insert(array(
            array('id'=>'1','semester'=>'x','year'=>'x','created_at'=>Carbon::now(),'updated_at'=>Carbon::now())
        ));
    }
}
