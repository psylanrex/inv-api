<?php

namespace App\CodeGenerator\Controllers\Removers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Removers\ServiceRemoverService;

class ServiceRemoverController extends Controller
{
    public function removeService(Request $request, ServiceRemoverService $service)
    {

        $request->validate([

            'service_name' => 'string|required',
            'service_folder_name' => 'string|required',
            'parent_folder_name' => 'string|required',
            'remove_all_services_in_folder' => 'boolean|required'

        ]);

        $message = $service->removeService($request);

        session()->flash('message', $message);

        return view('code-generators.index');


    }
}