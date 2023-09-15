<?php

namespace Database\Seeders\Services;

use App\Classes\Models\ModelPath;
use Illuminate\Support\Facades\Storage;

class SeedersService
{
    public function handle($table, $file): void
    {
        $model = ModelPath::makeModelPath($table);
        $model::truncate();

        $json = Storage::disk('data')->get($file);
        $datas = json_decode($json, true);

        foreach ($datas as $key => $item) {
            $model::factory()->create(
                match ($table) {
                    'VoucherTypes' => [
                        'name' => $item['name'],
                        'local' => $item['local'],
                        'localfund' => $item['localfund'],
                        'localreplay' => $item['localreplay'],
                        'description' => $item['description'],
                    ],
                    'UserTypes' => [
                        'name' => $item['name'],
                        'commit' => $item['commit'],
                    ],
                    'Users' => [
                        'username' => $item['username'],
                        'email' => $item['email'],
                        'email_verified_at' => $item['email_verified_at'],
                        'password' => $item['password'],
                        'remember_token' => $item['remember_token'],
                        'image_url' => $item['image_url'],
                        'usertypes_id' => $item['usertypes_id'],
                        'commit' => $item['commit'],
                    ],
                    'Settlements' => [
                        'name' => $item['name'],
                        'postcode' => $item['postcode'],
                        'description' => $item['description'],
                    ],
                    'PartnerTypes' => [
                        'name' => $item['name'],
                        'description' => $item['description'],
                    ],
                    'LogitemTypes' => [
                        'name' => $item['name'],
                        'description' => $item['description'],
                    ],
                    'DetailTypes' => [
                            'name' => $item['name'],
                            'listing' => $item['listing'],
                            'description' => $item['description'],
                    ],

                }
            );
        }
    }
}


