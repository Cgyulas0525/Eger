<?php

namespace App\Actions;

use App\Models\Partnerquestionnaries;

class PartnerQuestionnarieDelete
{
    public function handle($partner, $questionnaire): void
    {
        Partnerquestionnaries::where('partner_id', $partner)
            ->where('questionnarie_id', $questionnaire)
            ->update([
                'deleted_at' => now()->toDateTimeString(),
            ]);
    }
}
