<?php

namespace App\Services;

use DB;

class QuestionnaireService
{
    public function activeQuestionnaries() {
        return DB::table('questionnaires as t1')
            ->where('t1.active', 1)
            ->where('t1.validityfrom', '<=', date('Y-m-d', strtotime(now())))
            ->where(function ($query) {
                $query->where('t1.validityto', '>=', date('Y-m-d', strtotime(now())))
                    ->orWhereNull('t1.validityto');
            })
            ->whereNull('t1.deleted_at')
            ->get();
    }


    public function activeBasicQuestionnaries() {
        return DB::table('questionnaires as t1')
            ->where('t1.active', 1)
            ->where('t1.basicpackage', 1)
            ->where('t1.validityfrom', '<=', date('Y-m-d', strtotime(now())))
            ->where(function ($query) {
                $query->where('t1.validityto', '>=', date('Y-m-d', strtotime(now())))
                    ->orWhereNull('t1.validityto');
            })
            ->whereNull('t1.deleted_at')
            ->get();
    }

}
