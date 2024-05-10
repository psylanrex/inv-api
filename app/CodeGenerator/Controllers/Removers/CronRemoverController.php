<?php

namespace App\CodeGenerator\Controllers\Removers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveCronService;

class CronRemoverController extends Controller
{
    public function removeCron(Request $request, RemoveCronService $service)
    {

        $request->validate([

            'command_name' => 'string|required',
            'handler_name' => 'string|required'

        ]);

        $message = $service->removeCron($request);

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}