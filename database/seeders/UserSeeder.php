<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use faker to create a fake name
        $faker = \Faker\Factory::create();

        User::create([
            'name' => $faker->name(),
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
