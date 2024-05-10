<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;


class MakeStatusFilesService
{
    public $writer;
    public $findOrMakeDirectory;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectory = new FindOrMakeDirectoryService;

    }

    public function makeStatusFiles()
    {

        // set the paths we need

        $files = $this->setPaths();

        // confirm or make directories

        $this->makeDirectories();

        // write the files

        $this->writeFiles($files);
        
    }

    Public function writeFiles($files)
    {

        // feed in the template path and destination path into the writer


        foreach ( $files as $template => $file ) {

            $this->writer->writeFromTemplate($template, $file);

        }


    }

    public function makeDirectories()
    {

        // Statuses folder

        $statuses_folder = base_path() . '/app/Http/Controllers/Admin/Statuses'; 
        
        // we use array in case we need to expand

        $folders = [$statuses_folder];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectory->findOrMakeDirectory($folder);

        }


    }

    public function setPaths()
    {

        $seeder_template = base_path() . '/app/CodeGenerator/Templates/Projects/Seeds/status-seeds.txt';
        $seeder_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/StatusesSeederController.php';

        $controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/status-controller.txt';
        $controller_file = base_path() . '/app/Http/Controllers/Admin/Statuses/StatusesController.php';

        $model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/project-status-model.txt';
        $model_file = base_path() . '/app/Models/Status.php';

        $migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/status-migration.txt';
        $migration_file = base_path() . "/database/migrations/2023_11_22_000000_create_statuses_table.php";
        

        $files = [

            $seeder_template => $seeder_file,
            $controller_template => $controller_file,
            $model_template => $model_file,
            $migration_template => $migration_file

        ];

        return $files;

    }


}