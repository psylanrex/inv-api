<?php

namespace App\CodeGenerator\Removers;


use App\CodeGenerator\Removers\RemoveModelService;
use App\CodeGenerator\Removers\RemoveMigrationService;
use App\CodeGenerator\Removers\RemoveControllerService;
use App\CodeGenerator\Removers\RemoveFoundationRoutesService;
use App\CodeGenerator\Removers\RemoveModelFromRunSeedsService;
use App\CodeGenerator\Formatters\ModelNameFormatter;
use Illuminate\Support\Facades\File;

class RemoveCrudSystemService
{

    public $removeModelService;
    public $removeControllerService;
    public $removeMigrationService;
    public $removeFoundationRoutesService;
    public $removeModelFromRunSeedsService;

    public function __construct()
    {

        $this->removeModelService = new RemoveModelService;
        $this->removeMigrationService = new RemoveMigrationService;
        $this->removeControllerService = new RemoveControllerService;
        $this->removeFoundationRoutesService = new RemoveFoundationRoutesService;
        $this->removeModelFromRunSeedsService = new RemoveModelFromRunSeedsService;

    }

    public function removeCrudSystem($request)
    {

        $request->validate([

            'model' => 'string|required'
        ]);

        $request->merge(['model' => 'Crud']);

        $this->removeModelService->removeModel($request);
        $this->removeMigrationService->removeMigration($request);
        $this->removeControllerService->removeController($request);
        $this->removeFoundationRoutesService->removeRoutes($request);

        // Overwrite the value in the request
    
        $request->merge(['model' => 'FormConfig']);

        $this->removeModelService->removeModel($request);
        $this->removeMigrationService->removeMigration($request);
        $this->removeControllerService->removeController($request);
        $this->removeFoundationRoutesService->removeRoutes($request);

        // remove the rest of the files

        $this->removeOtherFiles();

        // remove model from run seeds controller

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('Crud');

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('FormConfig');

        return 'Base System Removed';


    }

    public function removeOtherFiles()
    {

        // seeds

        $form_configs_seeder_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';

        $seeder_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // requests 

        $crud_store_request_path = base_path() . '/app/Http/Requests/CrudStoreRequest.php';

        $crud_update_request_path = base_path() . '/app/Http/Requests/CrudUpdateRequest.php';

        $form_config_store_request_path = base_path() . '/app/Http/Requests/FormConfigStoreRequest.php';

        $form_config_update_request_path = base_path() . '/app/Http/Requests/FormConfigUpdateRequest.php';

        // Forms

        $add_form_config_service = base_path() . '/app/Services/Forms/AddFormConfigService.php';

        $edit_form_config_service = base_path() . '/app/Services/Forms/EditFormConfigService.php';

        $form_config_create_service = base_path() . '/app/Services/Forms/FormConfigCreateService.php';

        // Utilities

        $drop_down_list_maker = base_path() . '/app/Utilities/DropDownListMaker.php';
        $sort_by = base_path() . '/app/Utilities/SortBy.php';



        $files = [$form_configs_seeder_path, 
                  $seeder_path,
                  $crud_store_request_path,
                  $crud_update_request_path,
                  $form_config_store_request_path,
                  $form_config_update_request_path,
                  $add_form_config_service,
                  $edit_form_config_service,
                  $form_config_create_service,
                  $drop_down_list_maker,
                  $sort_by
                
                ];

        foreach ($files as $file) 
        {

            unlink($file);

        }


    }



}