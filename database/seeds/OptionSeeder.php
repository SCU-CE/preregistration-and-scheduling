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
        DB::table('options')->insert([
            ['id'=>'1','name'=>'current_semester','value'=>'1','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'2','name'=>'min_entry_year','value'=>'1392','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'3','name'=>'max_entry_year','value'=>'1396','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'4','name'=>'max_register_units','value'=>'20','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'5','name'=>'process_stage','value'=>'disable','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'6','name'=>'scheduling_stage','value'=>'1st','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'7','name'=>'prereg_start_date','value'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'8','name'=>'prereg_end_date','value'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'9','name'=>'eval_start_date','value'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'10','name'=>'eval_end_date','value'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'11','name'=>'final_date','value'=>'','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'12','name'=>'process_stage_state','value'=>'disable','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>'13','name'=>'active_eval_session','value'=>'0','created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]
        ]);
    }
}
