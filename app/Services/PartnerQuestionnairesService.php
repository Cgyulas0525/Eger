<?php

namespace App\Services;

use App\Models\Questionnaires;
use App\Models\Partners;

class PartnerQuestionnairesService
{
    public function PartnerQuestionnairesQuestionnaireNotConnected($id): object
    {
        return Questionnaires::where('active', 1)
            ->whereNotIn('id', function($query) use ($id) {
                $query->from('partnerquestionnaries')->select('questionnarie_id')->where('partner_id', $id)->whereNull('deleted_at')->get();
            })
            ->get();
    }

    public function PartnerQuestionnairesPartnerNotConnected($id): object
    {
        return Partners::where('active', 1)
            ->whereNotIn('id', function($query) use ($id) {
                $query->from('partnerquestionnaries')->select('partner_id')->where('questionnarie_id', $id)->whereNull('deleted_at')->get();
            })
            ->get();
    }
}
