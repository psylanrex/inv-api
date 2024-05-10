<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\ServiceCreators\MakeNewService;

class MakeNewServiceController extends Controller
{
    public function makeNewService(Request $request, MakeNewService $service)
    {

        $message = $service->makeNewService($request);

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}
