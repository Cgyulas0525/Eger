<?php
namespace App\Traits;

use App\Classes\Models\ModelPath;
use App\Classes\SWAlertClass;

trait BeforeActivationTrait {

    public function beforeActivation($id, $table, $route) {
        $view = 'layouts.show';
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);
        SWAlertClass::choice($id, 'Biztosan változtatni akarja az aktívitás jelzőt?', '/'.$route, 'Kilép', '/Activation/'.$id.'/'.$table.'/'.$route, 'Váltás');

        return view($view)->with('table', $data);
    }

}
