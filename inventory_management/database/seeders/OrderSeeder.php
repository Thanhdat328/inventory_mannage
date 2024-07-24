<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('orders')->insert([
                'name' => $faker->name,
                'product_id' => $i,
                'user_id'=> 1,
                'receiver_id' => 1,
                'quantity' => 5,
                'order_date' => now(),
                'return_date' => now()
            ]);
        }
    }
}
