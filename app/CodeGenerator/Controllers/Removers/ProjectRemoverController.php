<?php

namespace App\CodeGenerator\Controllers\Removers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveProjectService;


class ProjectRemoverController extends Controller
{
    public function removeProject(RemoveProjectService $service)
    {

        return $service->removeProject();      

    }
}
