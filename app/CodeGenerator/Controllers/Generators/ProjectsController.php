<?php

namespace App\CodeGenerator\Controllers\Generators;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Projects\ProjectSetUpService;

class ProjectsController extends Controller
{
    public function setUpProject(Request $request, ProjectSetUpService $service)
    {

        return $service->initializeProject($request);

    }
    
}
