<?php

namespace App\CodeGenerator\CrudSystem;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;


class CrudsBaseService
{

    public $writer;
    public $findOrMakeDirectoryService;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;

    }

    public function makeCrudsBase()
    {

        // set the paths we need

        $files = $this->setPaths();

        // confirm or make directories

        $this->makeDirectories();

        // write the files

        $this->writeFiles($files);

        return 'cruds model and files generated';

    }

    public function makeDirectories()
    {

        // make sure we have the necessary folders

        // Controller Admin folder

        $admin_folder_path = base_path() . '/app/Http/Controllers/Admin';

        $controller_file_path = base_path() . '/app/Http/Controllers/Admin/Cruds';

        // Dev and Seeders folder

        $dev_folder_path = base_path() . '/app/Http/Controllers/Admin/Dev';

        $seeders_folder_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders';

        // Requests folder

        $requests_folder_path = base_path() . '/app/Http/Requests';     

        $folders = [$admin_folder_path, 
                    $controller_file_path,
                    $dev_folder_path,
                    $seeders_folder_path,
                    $requests_folder_path
                ];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }


    }


    Public function writeFiles($files)
    {

        // feed in the template path and destination path into the writer


        foreach ( $files as $template => $file ) {

            $this->writer->writeFromTemplate($template, $file);

        }



    }

    public function setPaths()
    {

        // set the paths

        $migration_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Cruds/crud-migration.txt';

        $migration_path = base_path() . "/database/migrations/2023_11_06_000000_create_cruds_table.php";


        $controller_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Cruds/cruds-controller.txt';

        $controller_path = base_path() . '/app/Http/Controllers/Admin/Cruds/CrudsController.php';


        $model_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Cruds/crud-model.txt';

        $model_path = base_path() . '/app/Models/Crud.php';


        $seeds_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Cruds/crud-seeds.txt';

        $seeds_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';


        $store_request_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Cruds/crud-store-request.txt';

        $store_request_path = base_path() . '/app/Http/Requests/CrudStoreRequest.php';


        $update_request_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Cruds/crud-update-request.txt';

        $update_request_path = base_path() . '/app/Http/Requests/CrudUpdateRequest.php';


        $files = [

            $migration_template_file => $migration_path,
            $controller_template_file => $controller_path,
            $model_template_file => $model_path,
            $seeds_template_file => $seeds_path,
            $store_request_template_file => $store_request_path,
            $update_request_template_file => $update_request_path



        ];

        return $files;


    }


}