<?php

namespace App\Traits;

use App\Classes\Models\ModelPath;
use App\Classes\SWAlertClass;

trait BeforeActivationWithParamTrait {

    public function beforeActivationWithParam($table, $id, $route, $param = null) {
        $view = 'layouts.show';
        $model_name = ModelPath::makeModelPath($table);
        $record = $model_name::find($id);

        SWAlertClass::choice($id, 'Biztosan változtatni akarja az aktívitás jelzőt?', '/'.$route. '/' . $param, 'Kilép', '/ActivationWithParam/'.$table.'/'.$id.'/'.$route. '/'.$param, 'Váltás');
        return view($view)->with('table', $record);
    }

}

