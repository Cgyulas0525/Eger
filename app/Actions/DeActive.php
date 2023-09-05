<?php

namespace App\Actions;

use App\Classes\Models\ModelPath;
use App\Actions\LogItemInsert;

class DeActive
{

    private $logitem;

    public function __construct() {
        $this->logitem = new LogItemInsert();
    }

    public function handle($table) {
        $model_name = ModelPath::makeModelPath($table);
        $datas = $model_name::where('active', 1)
            ->where('validityfrom', '<=', date('Y.m.d', strtotime('today')))
            ->where('validityto', '<', date('Y.m.d', strtotime('today')))
            ->get();
        if (!empty($datas)) {
            foreach ($datas as $data) {
                $data->active = 0;
                $data->save();
                $this->logitem->iudRecord(7, $data->getTable(), $data->id);
            }
        }

    }
}
