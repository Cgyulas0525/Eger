<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\Services\SeedersService;

class VouchertypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        (new SeedersService())->handle('VoucherTypes', 'vouchertypes.data');
    }
}
