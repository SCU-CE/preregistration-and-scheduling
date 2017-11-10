<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->delete();
        DB::table('options')->insert(array(
            array('id'=>'1','name'=>'current_semester','value'=>'1','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('id'=>'2','name'=>'min_entry_year','value'=>'1392','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('id'=>'3','name'=>'max_entry_year','value'=>'1396','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()),
            array('id'=>'4','name'=>'max_register_units','value'=>'20','created_at'=>Carbon::now(),'updated_at'=>Carbon::now())
        ));
    }
}
