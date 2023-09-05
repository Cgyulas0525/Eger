<?php

namespace App\Actions;

use PDF;

class VoucherPdf
{
    public function handle($client, $voucher)
    {

        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.printingEmail', ['body' => 'printing.voucherPrintingBody', 'voucher' => $voucher, 'client' => $client]);

        $fileName = $voucher->partnerName . '-' . $client->name . '-' . $voucher->name . '-' . date('Y-m-d',strtotime('today')) .'-voucher.pdf';
        $path = public_path('print/'.$fileName);

        $pdf->save($path, 'UTF-8');

        return $path;

    }

}
