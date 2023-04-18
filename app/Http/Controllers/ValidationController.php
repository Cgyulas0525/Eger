<?php

namespace App\Http\Controllers;

use App\Traits\BeforeValidationTrait;
use App\Traits\BeforeValidatingValidationTrait;
use App\Traits\ValidatingTrait;
use App\Traits\ValidatingValidationTrait;
use App\Traits\ValidationTrait;

class ValidationController extends Controller
{

    use BeforeValidationTrait, BeforeValidatingValidationTrait, ValidatingTrait, ValidatingValidationTrait, ValidationTrait;

}
