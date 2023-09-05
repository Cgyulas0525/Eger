<?php

namespace App\Traits;

use App\Classes\Models\ModelPath;
use App\Actions\LogItemInsert;

trait ActivationTrait
{

    public function Activation($id, $table, $route)
    {
        $route .= '.index';
        $model_name = ModelPath::makeModelPath($table);
        $record = $model_name::find($id);

        if (empty($record)) {
            return redirect(route($route));
        }

        $record->active = $record->active == 0 ? 1 : 0;
        $record->save();
        $logitem = new LogItemInsert();
        $logitem->iudRecord($record->active == 1 ? 6 : 7, $record->getTable(), $record->id);

        return redirect(route($route));
    }

}

