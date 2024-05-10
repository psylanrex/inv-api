<?php

namespace App\CodeGenerator\Routes;

use App\CodeGenerator\Writers\Writer;

class ProjectRoutesService
{

    public $writer;

    public function __construct()
    {

        $this->writer = new Writer;


    }

    public function setUpRouteFile($request)
    {

        // leaving request in for now incase we want choices later

        $routes_path = base_path() . '/routes/api.php';

        $routes_template_file = base_path() . '/app/CodeGenerator/Templates/Projects/Routes/starter-route.txt';

        $this->writer->writeFromTemplate($routes_template_file, $routes_path);


    }



}