<?php

namespace App\Actions;

use App\Classes\LogitemClass;
use App\Models\Partnerquestionnaries;
use Carbon\Carbon;

class PartnerQuestionnarieInsert
{
    public function handle($partner, $questionnaire) {

        $partnerQuestionnarie = new Partnerquestionnaries();

        $partnerQuestionnarie->partner_id = $partner;
        $partnerQuestionnarie->questionnarie_id = $questionnaire;
        $partnerQuestionnarie->created_at = Carbon::now();

        $partnerQuestionnarie->save();
        $logitem = new LogitemClass();
        $logitem->iudRecord(3, $partnerQuestionnarie->getTable(), $partnerQuestionnarie->id);

    }

}
