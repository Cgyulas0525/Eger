<?php

namespace App\Traits;

use App\Classes\Models\ModelPath;
use App\Classes\SWAlertClass;

trait BeforeValidatingValidationTrait {
    /**
     * @param $id
     * @param $table
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * question before valadating
     */
    public function beforeValidatingValidation($id, $table) {
        $view = 'layouts.show';
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);
        SWAlertClass::choice($id, 'Biztosan validálja az ügyfelet?', '/validating/1/0', 'Kilép', '/validatingValidation/'.$id.'/'.$table, 'Váltás');

        return view($view)->with('table', $data);
    }

}
