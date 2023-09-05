<?php

namespace App\Services;

use App\Models\Validpostcodes;

class ClientService
{
    public function localCheck($postcode) {
        return Validpostcodes::where('postcode', $postcode)->where('active', 1)->get()->count();
    }

}
