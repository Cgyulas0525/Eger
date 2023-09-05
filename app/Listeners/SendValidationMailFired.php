<?php

namespace App\Listeners;

use App\Events\SendValidationMail;

use App\Models\Clientquestionnaries;
use App\Models\Clientvouchers;
use App\Models\Questionnaires;
use App\Models\Vouchers;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use DB;
USE Mail;
use Carbon\Carbon;

use App\Actions\VoucherPdf;
use App\Actions\QuestionnariePdf;

class SendValidationMailFired
{

    private $voucherPdf;
    private $questionnariePdf;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->voucherPdf = new VoucherPdf();
        $this->questionnariePdf = new QuestionnariePdf();
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SendValidationMail  $event
     * @return void
     */
    public function handle(SendValidationMail $event)
    {
        DB::afterCommit(function () use ($event) {
            $files = [];

            $clientvouchers = Clientvouchers::where('client_id', $event->client->id)->whereNull('posted')->get();
            if (!empty($clientvouchers)) {
                foreach($clientvouchers as $clientvoucher) {
                    $voucher = Vouchers::find($clientvoucher->voucher_id);
                    array_push($files, $this->voucherPdf->handle($event->client, $voucher));
                    $clientvoucher->posted = Carbon::now();
                    $clientvoucher->save();
                }
            }

            $clientquestionnaries = Clientquestionnaries::where('client_id', $event->client->id)->whereNull('posted')->get();
            if (!empty($clientquestionnaries)) {
                foreach ($clientquestionnaries as $clientquestionnarie) {
                    $questionnarie = Questionnaires::find($clientquestionnarie->questionnarie_id);
                    array_push($files, $this->questionnariePdf->handle($event->client, $questionnarie));
                    $clientquestionnarie->posted = Carbon::now();
                    $clientquestionnarie->save();
                }
            }

            $data["client"] = $event->client->name;
            $data["email"] = $event->client->email;
            $data["title"] = config('app.name') . ' alkalmazás!';
            $data["body"] = config('app.name') . ' alkalmazás új űrlapokat és vpuchereket küldött Önnek!';
            $data["datum"] = date('Y-m-d');

            Mail::send($event->mail, $data, function($message) use($files, $event, $data) {
                $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);

                foreach ($files as $file) {
                    $message->attach($file);
                }

            });

        });
    }
}
