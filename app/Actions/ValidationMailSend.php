<?php

namespace App\Actions;

use App\Events\SendValidationMail;
use App\Services\ClientService;

use App\Actions\BasicVouchersSend;
use App\Actions\BasicQuestionnariesSend;

use DB;
use Event;

class ValidationMailSend
{
    private $clientService;
    private $basicQuestionnariesSend;
    private $basicVouchersSend;

    public function __construct()
    {
        $this->clientService = new ClientService();
        $this->basicQuestionnariesSend = new BasicQuestionnariesSend();
        $this->basicVouchersSend = new BasicVouchersSend();
    }

    public function handle($record)
    {

        DB::transaction(function () use ($record) {
            $record->validated = $record->validated == 0 ? 1 : 0;
            $record->local = $this->clientService->localCheck($record->postcode);
            $record->save();

            (new LogItemInsert())->iudRecord(8, $record->getTable(), $record->id);

            $this->basicQuestionnariesSend->handle($record);
            $this->basicVouchersSend->handle($record);

            Event::dispatch(new SendValidationMail($record, 'emails.voucherMail'));
        });
    }
}
