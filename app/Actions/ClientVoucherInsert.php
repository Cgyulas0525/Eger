<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Clientvouchers;

class ClientVoucherInsert
{
    private $logitem;

    public function __construct() {
        $this->logitem = new LogItemInsert();
    }

    public function handle($client, $voucher) {

        $clientvoucher = new Clientvouchers();
        $clientvoucher->client_id = $client->id;
        $clientvoucher->voucher_id = $voucher->id;
        $clientvoucher->created_at = \Carbon\Carbon::now();
        $clientvoucher->save();

        $this->logitem->iudRecord(3, $clientvoucher->getTable(), $clientvoucher->id);

    }
}

