<?php

namespace App\Traits;

use App\Classes\Models\ModelPath;
use App\Actions\LogItemInsert;

trait DestroyWithParamTrait {
    public function destroyWithParam($table, $id, $route, $param) {
        $model_name = ModelPath::makeModelPath($table);
        $data = $model_name::find($id);

        if (empty($data)) {
            return redirect(route($route, $param));
        }

        switch (strtolower($table)) {
            case "contractannex":
                $this->deletingContractAnnex($data);
                break;
            case "contractdeadline":
                $this->deletingContractDeadLine($data);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";
        }

        $data->delete();
        $logitem = new LogItemInsert();
        $logitem->iudRecord(5, $data->getTable(), $data->id);

        return redirect(route($route,  $param));
    }

}
