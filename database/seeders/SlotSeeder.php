<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $slots = array(
            array('id'=>1, 'start'=>'10:00', 'end'=>'11:00'),
            array('id'=>2,'start'=>'11:00', 'end'=>'12:00'),
            array('id'=>3, 'start'=>'12:00', 'end'=>'13:00'),
            array('id'=>4, 'start'=>'13:00', 'end'=>'14:00'),
            array('id'=>5, 'start'=>'14:00', 'end'=>'15:00'),
            array('id'=>6, 'start'=>'15:00', 'end'=>'16:00'),
            array('id'=>7, 'start'=>'16:00', 'end'=>'17:00'),
            array('id'=>8, 'start'=>'17:00', 'end'=>'18:00'),
            array('id'=>9, 'start'=>'18:00', 'end'=>'19:00'),
            array('id'=>10, 'start'=>'19:00', 'end'=>'20:00'),
        );

        DB::table('slots')->insert($slots);
    }
}
