<?php

namespace Database\Seeders;

use App\Models\Receiver;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReceiversSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('receivers')->insert([
                'name' => $faker->name,
                'email' => $faker->safeEmail,
                'user_id'=> 1,
                'phone' => $faker->unique->phoneNumber,
                'address' => $faker->address,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
        
    }
}
