<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Clientquestionnaries;

class ClientQuestionnarieInsert
{

    private $logitem;

    public function __construct() {
        $this->logitem = new LogItemInsert();
    }

    public function handle($client, $questionnarie) {

        $clientquestionnarie = new Clientquestionnaries();
        $clientquestionnarie->client_id = $client->id;
        $clientquestionnarie->questionnarie_id = $questionnarie->id;
        $clientquestionnarie->created_at = \Carbon\Carbon::now();
        $clientquestionnarie->save();

        $this->logitem->iudRecord(3, $clientquestionnarie->getTable(), $clientquestionnarie->id);

    }
}

