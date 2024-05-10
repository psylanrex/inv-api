<?php

namespace App\CodeGenerator\Seeds;

use App\CodeGenerator\Writers\AddModelToRunSeeds;
use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Formatters\FillableColumnsFormatter;
use App\CodeGenerator\Formatters\TableNameFormatter;
use App\CodeGenerator\Assemblers\AssembleTemplateService;
use Illuminate\Support\Str;

class MakeSeedFileService
{

    public $addModelToRunSeeds;

    public function __construct()
    {

        $this->addModelToRunSeeds = new AddModelToRunSeeds;

    }

    public function makeSeedFile($request)
    {

        // create the seed file

        $this->createSeedFile($request);

        // when you make a seed file you need to add it to the RunSeedsController

        $this->addSeedModelToRunSeedsFile($request);


    }

    public function addSeedModelToRunSeedsFile($request)
    {

        $model = $request->get('model');

        $model = ModelNameFormatter::formatModelName($model);

        $this->addModelToRunSeeds->addModelToRunSeeds($model);


    }

    public function createSeedFile($request)
    {

        // Format model name

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        $table_name = TableNameFormatter::formatTableName($model_name);

        $model_name_plural = Str::plural($model_name);

        $template_file = base_path() . '/app/CodeGenerator/Templates/Seeds/seed.txt';

        $content = file_get_contents($template_file);

        $tempfile = base_path() . '/app/CodeGenerator/Seeds/temp.txt';

        // get fillable columns

        $fillable_columns = FillableColumnsFormatter::formatFillableColumns($request);

        // Convert the string to an array using explode

        $fillable_columns = explode(', ', $fillable_columns);

        foreach ($fillable_columns as $column) {

            $line = "\t\t\t{$column} => 'insert your value here',";

            // write each line to $tempfile
    
            file_put_contents($tempfile, $line . PHP_EOL, FILE_APPEND);

        }

        $fields_to_create = file_get_contents($tempfile);

        $tokens = ['MODELNAME' => $model_name, 
                   'TABLENAME' => $table_name, 
                   'MODELNAMEPLURAL' => $model_name_plural, 
                   'CREATECOLUMNSTEMPLATE' => $fields_to_create];

        // use assemble template service to read and format content

        $new_content = AssembleTemplateService::assembleTemplate($template_file, $tokens);

        // path for the new seeder file

        $file_name = $model_name_plural . 'SeederController.php';

        $file_path = base_path() . "/app/Http/Controllers/Admin/Dev/Seeders//{$file_name}";


        // Use file_put_contents to create the file and write contents

        file_put_contents($file_path, $new_content);
       

        // clean up tempfile

        // Open the file in write mode and truncate it

        $tempFileHandle = fopen($tempfile, 'w');

        // Close the file handle

        fclose($tempFileHandle);




    }



}