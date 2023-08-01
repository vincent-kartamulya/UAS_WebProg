<?php

namespace Database\Seeders;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class WeddingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $loc = ['Jakarta', 'Singapore', 'Tangerang'];

        for ($i = 0; $i < 100; $i++) {
            DB::table('weddings')->insert([
                'vendor' => $faker->company,
                'location' => $loc[rand(0, 2)],
                'image' => "vendor/vendor" . ($i % 3 + 1) . ".jpg",
                'price' => rand(1, 50) * 100000000,
                'address' => $faker->address
            ]);
        }

    }
}
