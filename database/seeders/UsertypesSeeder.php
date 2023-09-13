<?php

namespace Database\Seeders;

use App\Models\Usertypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UsertypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Usertypes::truncate();

        $json = Storage::disk('data')->get('usertypes.data');
        $vts = json_decode($json, true);

        foreach ($vts as $key => $vt) {
            Usertypes::factory()->create(
                [
                    'name' => $vt['name'],
                    'commit' => $vt['commit'],
                ]
            );
        }
    }
}
