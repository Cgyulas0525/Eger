<?php

namespace App\Actions;

use Carbon\Carbon;
use DB;

class PartnerQuestionnarieDelete
{
    public function handle($partner, $questionnaire) {
        DB::table('partnerquestionnaries')
            ->where('partner_id', $partner)
            ->where('questionnarie_id', $questionnaire)
            ->update([
                'deleted_at' => Carbon::now()
            ]);

    }
}
