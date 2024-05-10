<?php

namespace App\CodeGenerator\Controllers\Removers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveCrudSystemService;
use App\CodeGenerator\Requests\RemoveFoundationRequest;

class CrudSystemRemoverController extends Controller
{
    public function removeCrudSystem(RemoveFoundationRequest $request, RemoveCrudSystemService $service)
    {

        return $service->removeCrudSystem($request);


    }
}
