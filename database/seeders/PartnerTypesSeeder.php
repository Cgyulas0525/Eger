<?php
namespace Database\Seeders;

use App\Models\PartnerTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PartnerTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        PartnerTypes::truncate();

        $json = Storage::disk('data')->get('partnertypes.data');
        $vts = json_decode($json, true);

        foreach ($vts as $key => $vt) {
            PartnerTypes::factory()->create(
                [
                    'name' => $vt['name'],
                    'description' => $vt['description'],
                ]
            );
        }
    }
}
