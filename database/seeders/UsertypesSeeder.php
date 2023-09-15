<?php

namespace Database\Seeders;

use Database\Seeders\Services\SeedersService;
use Illuminate\Database\Seeder;

class UsertypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        (new SeedersService())->handle('UserTypes', 'usertypes.data');
    }
}
