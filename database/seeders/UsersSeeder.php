<?php

namespace Database\Seeders;

use Database\Seeders\Services\SeedersService;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        (new SeedersService())->handle('Users', 'users.data');
    }
}
