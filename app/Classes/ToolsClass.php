<?php

namespace App\Classes;

use App\Classes\Models\ModelPath;
use App\Models\Clientquestionnaries;
use App\Models\Partners;
use App\Models\Clients;
use DB;

class ToolsClass
{
    public static function modelCount($table): int
    {
        $model_name = ModelPath::makeModelPath($table);
        return $model_name::where('active', 1)->get()->count();
    }

    public static function usedQuestionnaireCount($id): int
    {
        return Clientquestionnaries::where('questionnarie_id', $id)
                ->get()
                ->count();
    }

    public static function partnersLocalActive(array $active, array $vpactive): object
    {
        return Partners::whereIn('t1.postcode', function ($query) use ($vpactive) {
                return $query->from('validpostcodes as t2')->select('t2.postcode')->whereNull('t2.deleted_at')->whereIn('t2.active', $vpactive)->get();
            })
            ->whereIn('t1.active', $active)
            ->get();
    }

    public static function partnersNonLocalActive(array $active, array $vpactive): object
    {
        return Partners::whereNotIn('t1.postcode', function ($query) use ($vpactive) {
                return $query->from('validpostcodes as t2')->select('t2.postcode')->whereNull('t2.deleted_at')->whereIn('t2.active', $vpactive)->get();
            })
            ->whereIn('t1.active', $active)
            ->get();
    }

    public static function toBeValidated(): object
    {
        return Clients::where('t1.active', '=', 1)
                ->where('t1.validated', '=', 0)
                ->get();
    }

}
