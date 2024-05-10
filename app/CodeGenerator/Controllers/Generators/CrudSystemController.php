<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\CrudSystem\CrudSystemService;

class CrudSystemController extends Controller
{
    public function makeCrudSystem(CrudSystemService $service)
    {

        return $service->makeCrudSystem();

    }
}
