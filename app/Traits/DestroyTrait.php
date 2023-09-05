<?php

namespace App\Traits;

use App\Classes\Models\ModelPath;
use App\Actions\LogItemInsert;

trait DestroyTrait {
    public function destroy($table, $id, $route) {
        $route .= '.index';
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route));
        }

        $data->delete();
        $logitem = new LogItemInsert();
        $logitem->iudRecord(5, $data->getTable(), $data->id);

        return redirect(route($route));
    }

}
