<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Requests\MakeCronRequest;
use App\CodeGenerator\Crons\MakeCronService;

class MakeCronController extends Controller
{
    public function makeCron(MakeCronRequest $request, MakeCronService $service)
    {

        $message = $service->makeCron($request);

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}
