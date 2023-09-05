<?php

namespace  App\Traits;

use App\Classes\Models\ModelPath;
use App\Classes\SWAlertClass;

trait BeforeValidationTrait {
    /**
     * @param $id
     * @param $table
     * @param $route
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * question before validation
     */
    public function beforeValidation($id, $table, $route) {
        $view = 'layouts.show';
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);
        SWAlertClass::choice($id, 'Biztosan validálja az ügyfelet?', '/'.$route, 'Kilép', '/Validation/'.$id.'/'.$table.'/'.$route, 'Váltás');

        return view($view)->with('table', $data);
    }

}
