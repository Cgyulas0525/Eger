<?php

namespace App\Traits;

use App\Services\ModelPathService;
use App\Actions\ValidationMailSend;

trait ValidationTrait {

    private $modelPathService;
    private $validationMailSend;

    /**
     * @param $id
     * @param $table
     * @param $route
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * validating client
     */
    public function Validation($id, $table, $route) {

        $this->modelPathService = new ModelPathService();

        $route .= '.index';
        $record = $this->modelPathService->getItem($table, $id);

        if (empty($record)) {
            return redirect(route($route));
        }

        $this->validationMailSend = new ValidationMailSend();
        $this->validationMailSend->handle($record);

        return redirect(route($route));
    }

}
