<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create('id_ID');
        $loc = ['Jakarta', 'Singapore', 'Tangerang'];

        for ($i = 0; $i < 100; $i++) {
            DB::table('weddings')->insert([
                'vendor' => $faker->company,
                'location' => $loc[rand(0, 2)],
                'image' => "wedding.png",
                'price' => rand(1, 50) * 10,
                'address' => $faker->address
            ]);
        }
        DB::table('users')->insert([
            'id' => 'SKY00101',
            'name' => 'Vincent',
            'email' => 'vincent@gmail.com',
            'datingCode' => 'DT001',
            'birthdate' => '2024-02-02',
            'gender' => 'male',
            'phoneNumber' => '+6522895352425784',
            'imagePath' => 'public/profiles/SKY00101.png',
            'password' => Hash::make('vincent'),
            'banned' => 0,
            'role' => 'user'
        ]);

        DB::table('users')->insert([
            'id' => 'SKY00102',
            'name' => 'Cincen',
            'email' => 'cincen@gmail.com',
            'datingCode' => 'DT001',
            'birthdate' => '2024-02-02',
            'gender' => 'female',
            'phoneNumber' => '+650890890890',
            'imagePath' => 'public/profiles/SKY00102.jpg',
            'password' => Hash::make('cincen'),
            'banned' => 0,
            'role' => 'user'
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
