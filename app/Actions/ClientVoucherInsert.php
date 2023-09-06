<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Clientvouchers;

class ClientVoucherInsert
{
    public function handle($client, $voucher): void
    {
        $clientvoucher = new Clientvouchers();
        $clientvoucher->client_id = $client->id;
        $clientvoucher->voucher_id = $voucher->id;
        $clientvoucher->created_at = \Carbon\Carbon::now();
        $clientvoucher->save();

        (new LogItemInsert())->iudRecord(3, $clientvoucher->getTable(), $clientvoucher->id);
    }
}

