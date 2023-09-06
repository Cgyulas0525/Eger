<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Validpostcodes;

class ValidPostcodesInsert
{
    public function handle($id, $postcode)
    {
        $validpostcodes = new Validpostcodes();
        $validpostcodes->settlement_id = $id;
        $validpostcodes->postcode = $postcode;
        $validpostcodes->active = 1;
        $validpostcodes->created_at = now()->toDateTimeString();
        $validpostcodes->save();
        (new LogitemClass())->iudRecord(3, $validpostcodes->getTable(), $validpostcodes->id);
    }
}
