<?php

namespace App\Services;

use DB;

class VoucherService
{
    public function validVouchers() {
        return DB::table('vouchers as t1')
            ->join('vouchertypes as t2', 't2.id', '=', 't1.vouchertype_id')
            ->where('t1.active', 1)
            ->where('t1.validityfrom', '<=', date('Y-m-d', strtotime(now())))
            ->where(function ($query) {
                $query->where('t1.validityto', '>=', date('Y-m-d', strtotime(now())))
                    ->orWhereNull('t1.validityto');
            })
            ->whereNull('t1.deleted_at')
            ->get();
    }

    public function validFundVouchers() {
        return DB::table('vouchers as t1')
            ->join('vouchertypes as t2', 't2.id', '=', 't1.vouchertype_id')
            ->join('partners as t3', 't3.id', '=', 't1.partner_id')
            ->select('t1.*', 't3.name as partnerName')
            ->where('t1.active', 1)
            ->where('t2.localfund', 1)
            ->where('t1.validityfrom', '<=', date('Y-m-d', strtotime(now())))
            ->where(function ($query) {
                $query->where('t1.validityto', '>=', date('Y-m-d', strtotime(now())))
                    ->orWhereNull('t1.validityto');
            })
            ->whereNull('t1.deleted_at')
            ->get();
    }

}
