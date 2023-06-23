<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plans')->insert([
            'id'=>1,
            'name'=>'Free Plan',
            'stripe_plan'=>'price_1MOjmPEnpsfQaHkImwfrBRKv',
            'price'=>0.00,
            'description'=>'1 join'
        ]);

        DB::table('plans')->insert([
            'id'=>2,
            'name'=>'Start Plan',
            'stripe_plan'=>'price_1MOjn9EnpsfQaHkIMbqU44wK',
            'price'=>15.00,
            'description'=>'5 joins'
        ]);

        DB::table('plans')->insert([
            'id'=>3,
            'name'=>'Basic Plan',
            'stripe_plan'=>'price_1MOjnrEnpsfQaHkIBsMURNBO',
            'price'=>25.00,
            'description'=>'50 joins'
        ]);

        DB::table('plans')->insert([
            'id'=>4,
            'name'=>'Premium Plan',
            'stripe_plan'=>'price_1MOjoLEnpsfQaHkI6h9CKNwk',
            'price'=>100.00,
            'description'=>'Unlimited joins'
        ]);
    }
}
