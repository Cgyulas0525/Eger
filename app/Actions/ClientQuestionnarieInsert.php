<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Clientquestionnaries;

class ClientQuestionnarieInsert
{
    public function handle($client, $questionnarie): void
    {
        $clientquestionnarie = new Clientquestionnaries();
        $clientquestionnarie->client_id = $client->id;
        $clientquestionnarie->questionnarie_id = $questionnarie->id;
        $clientquestionnarie->created_at = now()->toDateTimeString();
        $clientquestionnarie->save();

        (new LogItemInsert())->iudRecord(3, $clientquestionnarie->getTable(), $clientquestionnarie->id);
    }
}

