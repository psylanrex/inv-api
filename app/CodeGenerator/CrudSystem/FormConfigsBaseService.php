<?php

namespace App\CodeGenerator\CrudSystem;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class FormConfigsBaseService
{

    public $writer;
    public $findOrMakeDirectoryService;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;

    }

    public function makeFormConfigsBase()
    {

        // set the paths we need

        $files = $this->setPaths();

        // make sure we have the folder we need

        $this->makeDirectories();

        // write the files

        $this->writeFiles($files);

        return 'form configs model and files generated';


    }

    public function makeDirectories()
    {

        // Controller folder

        $controlller_folder = base_path() . '/app/Http/Controllers/Admin/FormConfigs';  
        
        // we use array format in case we need more folders

        $folders = [$controlller_folder];

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

        

        $migration_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-configs-migration.txt';

        $migration_path = base_path() . "/database/migrations/2023_11_07_000000_create_form_configs_table.php";


        $controller_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-configs-controller.txt';

        $controller_path = base_path() . '/app/Http/Controllers/Admin/FormConfigs/FormConfigsController.php';


        $model_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-configs-model.txt';

        $model_path = base_path() . '/app/Models/FormConfig.php';


        $seeds_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-configs-seeds.txt';

        $seeds_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';


        $store_request_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-config-store-request.txt';

        $store_request_path = base_path() . '/app/Http/Requests/FormConfigStoreRequest.php';


        $update_request_template_file = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-config-update-request.txt';

        $update_request_path = base_path() . '/app/Http/Requests/FormConfigUpdateRequest.php';

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