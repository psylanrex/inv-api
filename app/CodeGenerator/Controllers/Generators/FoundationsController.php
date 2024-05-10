<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Requests\MakeFoundationRequest;
use App\CodeGenerator\Foundations\MakeFoundationService;

class FoundationsController extends Controller
{
    public function makeFoundation(MakeFoundationRequest $request, MakeFoundationService $service)
    {

        $message = $service->makeFoundation($request);

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}
