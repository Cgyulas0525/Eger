<?php

namespace App\Actions;

use PDF;

class QuestionnariePdf
{
    /**
     * @param $client
     * @param $questionnarie
     * @return string
     *
     * new querionnarie pdf file for client
     */
    public function handle($client, $questionnarie): string
    {
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
            ->loadView('printing.printingEmail', ['body' => 'printing.questionnairePrintingBody', 'questionnaire' => $questionnarie, 'client' => $client]);

        $fileName = $client->name . '-' . $questionnarie->name . '-' . date('Y-m-d',strtotime('today')) .'-kérdőív.pdf';
        $path = public_path('print/'.$fileName);

        $pdf->save($path, 'UTF-8');

        return $path;
    }


}
