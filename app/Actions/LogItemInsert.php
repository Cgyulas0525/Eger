<?php

namespace App\Actions;

use App\Models\Logitems;
use myUser;
use Carbon;

class LogItemInsert
{
    public function iudRecord($logitemtype_id, $datatable, $record): void
    {
        $logitem = new Logitems();
        $logitem->logitemtype_id = $logitemtype_id;
        $logitem->user_id = myUser::user()->id;
        $logitem->datatable = $datatable;
        $logitem->record = $record;
        $logitem->eventdatetime = Carbon\Carbon::now();
        $logitem->created_at = Carbon\Carbon::now();

        $logitem->save();
    }
}
