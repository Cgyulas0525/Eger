<?php

namespace App\Http\Controllers;

use App\Traits\BeforeActivationTrait;
use App\Traits\BeforeActivationWithParamTrait;
use App\Traits\ActivationTrait;
use App\Traits\ActivationWithParamTrait;

class ChangeActiveController extends Controller
{

    use BeforeActivationTrait, BeforeActivationWithParamTrait, ActivationTrait, ActivationWithParamTrait;

}
