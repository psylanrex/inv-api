<?php

namespace App\CodeGenerator\Seeds;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\MakeAdminDevSeedersFolders;

class ProjectRunSeedsService
{

    public $writer;

    public function __construct()
    {

        $this->writer = new Writer;

    }

    public function makeRunSeedsController($request)
    {

        // leaving request in for now incase we want choices later

        $file_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/RunSeedsController.php';

        $template_file = base_path() . '/app/CodeGenerator/Templates/Seeds/run-seeds-controller.txt';

        MakeAdminDevSeedersFolders::makeFolders();

        // write the file

        $this->writer->writeFromTemplate($template_file, $file_path);

    }

}