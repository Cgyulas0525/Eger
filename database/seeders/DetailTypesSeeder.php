<?php

namespace Database\Seeders;

use Database\Seeders\Services\SeedersService;
use Illuminate\Database\Seeder;

class DetailTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        (new SeedersService())->handle('DetailTypes', 'detailtypes.data');
    }
}
