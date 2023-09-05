<?php

namespace App\Traits;

use App\Classes\ToolsClass;
use App\Services\ModelPathService;
use App\Actions\ValidationMailSend;

trait ValidatingValidationTrait {

    private $modelPathService;
    private $validationMailSend;

    /**
     * @param $id
     * @param $table
     *
     * client valadating
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function validatingValidation($id, $table) {

        $this->modelPathService = new ModelPathService();

        $route = '/validating/1/0';
        $record = $this->modelPathService->getItem($table, $id);

        if (empty($record)) {
            return redirect(route('validating', [1,0]));
        }

        $this->validationMailSend = new ValidationMailSend();
        $this->validationMailSend->handle($record);

        if (ToolsClass::toBeValidated()->count() > 0) {
            return redirect(route('validating', [1,0]));
        } else {
            return redirect(route('dashboard'));
        }
    }

}
