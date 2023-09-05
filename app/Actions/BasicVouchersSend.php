<?php

namespace App\Actions;

use App\services\VoucherService;
use App\Actions\ClientVoucherInsert;

class BasicVouchersSend
{
    private $vs;
    private $clientVoucherInsert;

    public function __construct() {
        $this->vs = new VoucherService();
        $this->clientVoucherInsert = new ClientVoucherInsert();
    }

    public function handle($record) {
        $vouchers = $this->vs->validFundVouchers();
        if (!empty($vouchers)) {
            foreach ($vouchers as $voucher) {
                $this->clientVoucherInsert->handle($record, $voucher);
            }
        }
    }

}
