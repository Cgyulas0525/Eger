<?php

namespace App\Services;


use App\Classes\Models\ModelPath;

class ModelPathService
{
    public function getItem($table, $id) {
        $model_name = ModelPath::makeModelPath($table);
        return $model_name::find($id);
    }
}
