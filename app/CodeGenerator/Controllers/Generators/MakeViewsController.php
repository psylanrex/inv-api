<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Views\MakeViewsService;

class MakeViewsController extends Controller
{
    public function makeViews(MakeViewsService $service)
    {

        return $service->makeViews();

    }
}