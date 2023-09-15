<?php

namespace Database\Seeders;

use App\Models\DetailTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DetailTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DetailTypes::truncate();

        $json = Storage::disk('data')->get('detailtypes.data');
        $vts = json_decode($json, true);

        foreach ($vts as $key => $vt) {
            DetailTypes::factory()->create(
                [
                    'name' => $vt['name'],
                    'listing' => $vt['listing'],
                    'description' => $vt['description'],
                ]
            );
        }
    }
}
