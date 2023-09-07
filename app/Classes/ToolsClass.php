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
        return Partners::whereIn('postcode', function ($query) use ($vpactive) {
                return $query->from('validpostcodes')->select('postcode')->whereNull('deleted_at')->whereIn('active', $vpactive)->get();
            })
            ->whereIn('active', $active)
            ->get();
    }

    public static function partnersNonLocalActive(array $active, array $vpactive): object
    {
        return Partners::whereNotIn('postcode', function ($query) use ($vpactive) {
                return $query->from('validpostcodes')->select('postcode')->whereNull('deleted_at')->whereIn('active', $vpactive)->get();
            })
            ->whereIn('active', $active)
            ->get();
    }

    public static function toBeValidated(): object
    {
        return Clients::where('active', '=', 1)
                ->where('validated', '=', 0)
                ->get();
    }

}
