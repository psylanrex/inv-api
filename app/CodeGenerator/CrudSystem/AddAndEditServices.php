<?php

namespace App\CodeGenerator\CrudSystem;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class AddAndEditServices
{

    public $writer;
    public $findOrMakeDirectoryService;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;


    }

    public function makeEditAndAddServices()
    {

        // set the paths we need

        $files = $this->setPaths();

        // make sure we have the folder we need

        $this->makeDirectories();

        // write the files

        $this->writeFiles($files);

        return 'make the Add and Edit services';

    }

    public function makeDirectories()
    {

        // Services folder

        $services_folder = base_path() . '/app/Services';
        
        $form_services_folder = base_path() . '/app/Services/Forms';
        
        // we use array format in case we need more folders

        $folders = [$services_folder, $form_services_folder];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }


    }

    public function writeFiles($files)
    {

        // feed in the template path and destination path into the writer

        foreach ( $files as $template => $file ) {

            $this->writer->writeFromTemplate($template, $file);

        }  

    }

    public function setPaths()
    {


        $add_form_config_template = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/add-form-config-service.txt';

        $add_form_config_path = base_path() . '/app/Services/Forms/AddFormConfigService.php';


        $edit_form_config_template = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/edit-form-config-service.txt';

        $edit_form_config_path = base_path() . '/app/Services/Forms/EditFormConfigService.php';


        $form_config_create_template = base_path() . '/app/CodeGenerator/Templates/CrudSystem/FormConfigs/form-config-create-service.txt';

        $form_config_create_path = base_path() . '/app/Services/Forms/FormConfigCreateService.php';

        $files = [

            $add_form_config_template => $add_form_config_path,
            $edit_form_config_template => $edit_form_config_path,
            $form_config_create_template =>$form_config_create_path

        ];

        return $files;


    }


}