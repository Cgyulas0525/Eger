<?php

namespace App\Http\Controllers;

use App\Traits\BeforeDestroyTrait;
use App\Traits\BeforeActivationWithParamTrait;
use App\Traits\BeforeDestroysWithParamArrayTrait;
use App\Traits\DestroyTrait;
use App\Traits\DestroyWithParamTrait;

class DestroysController extends Controller
{

    use BeforeDestroyTrait, BeforeActivationWithParamTrait, BeforeDestroysWithParamArrayTrait, DestroyTrait, DestroyWithParamTrait;

}
