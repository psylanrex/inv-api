<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\SupportSystem\MakeSupportSystemService;

class SupportSystemController extends Controller
{
    public function makeSupportSystem(MakeSupportSystemService $service)
    {

        return $service->makeSupportSystem();


    }
}
