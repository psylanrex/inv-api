<?php

namespace App\CodeGenerator\Controllers\Removers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Requests\RemoveFoundationRequest;
use App\CodeGenerator\Removers\RemoveFoundationService;

class FoundationRemoverController extends Controller
{
    public function removeFoundation(RemoveFoundationRequest $request, RemoveFoundationService $service)
    {

        $message = $service->removeFoundation($request);

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}
