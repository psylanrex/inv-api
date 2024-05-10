<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Projects\AddToEnvService;

class AddToEnvController extends Controller
{
    public function addToEnv(AddToEnvService $service)
    {

        $message = $service->addToEnv();

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}
