<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Validpostcodes;
use Carbon\Carbon;

class ValidPostcodesInsert
{
    public function handle($id, $postcode) {
        $validpostcodes = new Validpostcodes();
        $validpostcodes->settlement_id = $id;
        $validpostcodes->postcode = $postcode;
        $validpostcodes->active = 1;
        $validpostcodes->created_at = Carbon::now();
        $validpostcodes->save();

        $logitem = new LogitemClass();
        $logitem->iudRecord(3, $validpostcodes->getTable(), $validpostcodes->id);
    }
}
