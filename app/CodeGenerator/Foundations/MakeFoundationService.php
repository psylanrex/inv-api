<?php

namespace App\CodeGenerator\Foundations;

use App\CodeGenerator\Models\ModelService;
use App\CodeGenerator\Migrations\MigrationService;
use App\CodeGenerator\Controllers\ControllerService;
use App\CodeGenerator\Routes\FoundationRoutesService;
use App\CodeGenerator\Seeds\FoundationSeedService;
use App\CodeGenerator\Formatters\ModelNameFormatter;
use Illuminate\Support\Facades\File;

class MakeFoundationService
{

    public $modelService;
    public $migrationService;
    public $controllerService;
    public $foundationRoutesService;
    public $foundationSeedService;

    public function __construct()
    {

        $this->modelService = new ModelService;
        $this->migrationService = new MigrationService;
        $this->controllerService = new ControllerService;
        $this->foundationRoutesService = new FoundationRoutesService;
        $this->foundationSeedService = new FoundationSeedService;

    }

    public function makeFoundation($request)
    {


        // Format model name

        $model_name = $request->get('model');

        $has_seeds = $request->get('has_seeds');
    

        $model_name = ModelNameFormatter::formatModelName($model_name);

        // check if file already exists

        if ( File::exists(base_path() . "/app/Models/{$model_name}.php" ) ) {

            return 'Cannot made foundation, model already exists';


        }

        if ( ! $request->filled('column_1_name') || ! $request->filled('column_1_type') ) {

            return 'Column 1 data incomplete. Please make sure you have name and type values set.';
        }

         $this->modelService->makeModel($request);

         // $this->migrationService->makeMigration($request);

         $this->controllerService->makeController($request);

         $this->foundationRoutesService->makeRoutes($request);

        //  if ( $has_seeds == 1 ) {

        //     $this->foundationSeedService->makeSeeds($request);


        //  }

         

        return "Houston, we have ignition! You created the foundation for {$model_name}.";
        

    }



}