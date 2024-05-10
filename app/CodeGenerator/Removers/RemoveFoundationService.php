<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Removers\RemoveModelService;
use App\CodeGenerator\Removers\RemoveMigrationService;
use App\CodeGenerator\Removers\RemoveControllerService;
use App\CodeGenerator\Removers\RemoveFoundationRoutesService;
use App\CodeGenerator\Removers\RemoveFoundationCrudSeedService;
use App\CodeGenerator\Removers\RemoveFoundationFormConfigService;
use App\CodeGenerator\Formatters\ModelNameFormatter;
use Illuminate\Support\Facades\File;

class RemoveFoundationService
{

    public $removeModelService;
    public $removeMigrationService;
    public $removeControllerService;
    public $removeFoundationCrudSeedService;
    public $removeFoundationFormConfigSeedService;  
    public $removeModelFromRunSeedsService;
    public $removeSeedFileService;

    public function __construct()
    {

        $this->removeModelService = new RemoveModelService;
        $this->removeMigrationService = new RemoveMigrationService;
        $this->removeControllerService = new RemoveControllerService;
        $this->removeFoundationRoutesService = new RemoveFoundationRoutesService;
        $this->removeFoundationCrudSeedService = new RemoveFoundationCrudSeedService;
        $this->removeFoundationFormConfigSeedService = new RemoveFoundationFormConfigSeedService;
        $this->removeModelFromRunSeedsService = new RemoveModelFromRunSeedsService;
        $this->removeSeedFileService = new RemoveSeedFileService;


    }

    public function removeFoundation($request)
    {

        // Format model name

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        // check if file already exists

        if ( ! File::exists(base_path() . "/app/Models/{$model_name}.php" ) ) {

            return 'Model does not exist.';


        }

       $this->removeModelService->removeModel($request);
       $this->removeMigrationService->removeMigration($request);
       $this->removeControllerService->removeController($request);
       $this->removeFoundationRoutesService->removeRoutes($request);
       $this->removeFoundationCrudSeedService->removeCrudSeed($request);
       $this->removeFoundationFormConfigSeedService->removeFormConfigSeed($request);
       $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController($model_name);
       $this->removeSeedFileService->removeSeedFile($model_name);

       return "{$model_name} foundation has been removed.";
     
        
    }



}