<?php

namespace Database\Seeders;

use App\Models\Users;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Users::truncate();

        $json = Storage::disk('data')->get('users.data');
        $vts = json_decode($json, true);

        foreach ($vts as $key => $vt) {
            Users::factory()->create(
                [
                    'username' => $vt['username'],
                    'email' => $vt['email'],
                    'email_verified_at' => $vt['email_verified_at'],
                    'password' => $vt['password'],
                    'remember_token' => $vt['remember_token'],
                    'image_url' => $vt['image_url'],
                    'usertypes_id' => $vt['usertypes_id'],
                    'commit' => $vt['commit'],
                ]
            );
        }
    }
}
