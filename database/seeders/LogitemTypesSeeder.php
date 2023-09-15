<?php

namespace Database\Seeders;

use App\Models\LogitemTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LogitemTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        LogitemTypes::truncate();

        $json = Storage::disk('data')->get('logitemtypes.data');
        $vts = json_decode($json, true);

        foreach ($vts as $key => $vt) {
            LogitemTypes::factory()->create(
                [
                    'name' => $vt['name'],
                    'description' => $vt['description'],
                ]
            );
        }
    }
}
