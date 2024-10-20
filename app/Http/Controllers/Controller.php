<?php

namespace App\Http\Controllers;

use App\Traits\QueryBuilderTrait;

abstract class Controller
{
    use QueryBuilderTrait;
}
