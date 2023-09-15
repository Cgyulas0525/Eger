<?php
namespace Database\Seeders;

use App\Models\PartnerTypes;
use Database\Seeders\Services\SeedersService;
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
        (new SeedersService())->handle('PartnerTypes', 'partnertypes.data');
    }
}
