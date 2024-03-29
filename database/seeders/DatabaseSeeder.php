<?php

namespace Database\Seeders;

use App\Models\Usertypes;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UsertypesSeeder::class,
            UsersSeeder::class,
            SettlementsSeeder::class,
            VouchertypesSeeder::class,
        ]);
    }
}
