<?php

namespace Database\Seeders;

use App\Models\Vouchertypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class VouchertypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Vouchertypes::truncate();

        $json = Storage::disk('data')->get('vouchertypes.data');;
        $vts = json_decode($json, true);

        foreach ($vts as $key => $vt) {
            Vouchertypes::factory()->create(
                [
                    'name' => $vt['name'],
                    'local' => $vt['local'],
                    'localfund' => $vt['localfund'],
                    'localreplay' => $vt['localreplay'],
                    'description' => $vt['description'],
                ]
            );
        }
    }
}
