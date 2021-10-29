<?php

namespace Database\Seeders;

use App\Models\IP;
use Illuminate\Database\Seeder;

class IPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        IP::factory()
            ->count(10)
            ->create();
    }
}
