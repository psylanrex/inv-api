<?php

namespace App\CodeGenerator\Seeds;

use App\Models\Crud;
use App\CodeGenerator\Formatters\TableNameFormatter;
use App\CodeGenerator\Formatters\ModelNameFormatter;
use App\CodeGenerator\Formatters\FormatModelLabel;
use App\CodeGenerator\Formatters\FormatColumnsArray;
use App\CodeGenerator\Assemblers\AssembleTemplateService;
use App\CodeGenerator\Assemblers\AssembleFormConfigSeedsService;
use App\CodeGenerator\Seeds\MakeSeedFileService;
use App\CodeGenerator\Tokens\InsertTokensService;
use Illuminate\Support\Str;


class FoundationSeedService
{

    public $insertTokensService;
    public $assembleFormConfigSeeds;
    public $makeSeedFileService;

    public function __construct()
    {

        $this->insertTokensService = new InsertTokensService;
        $this->assembleFormConfigSeeds = new AssembleFormConfigSeedsService;
        $this->makeSeedFileService = new MakeSeedFileService;

    }


    public function makeSeeds($request)
    {

       $this->makeCrudSeed($request);

       $this->makeFormConfigSeeds($request);

       $this->makeSeedFileService->makeSeedFile($request);
        
    }

    public function makeFormConfigSeeds($request)
    {

        // format columns array

        $columns =FormatColumnsArray::buildColumnsArray($request);


        // create empty arrays to hold the names of the formconfigs we need to create
        // the arrays are named by the type of formconfig by type of value that we need to create,


        $booleans = [];
        $texts = [];
        $numbers = [];
        $selects = [];
        $files = [];

        // iterate over $columns to put the name of the column in the correct array
        // for example: an unsigned integer is indicative of relation, ultimately
        // we want to create a dropdown list for these, so we put the names in the
        // $selects array. A string will go into $texts because it will be a text field on the frontend

        // $columns is a nested array, so we have a nested foreach loop

        foreach ($columns as $key => $value) {

            foreach ($value as $name => $type) {

                if ( $type == 'boolean' || $type == 'boolean-default' ) {

                    $booleans [] = $name;

                }

                if ( $type == 'string' || $type == 'string-unique' ) {

                    $texts [] = $name;

                }

                if ( $type == 'unsigned-integer' ) {

                    $selects [] = $name;

                }

                if ( $type == 'integer' ) {

                    $numbers [] = $name;

                }

                if ( $type == 'file' ) {

                    $files [] = $name;

                }


            }

            
        }

        $crud_id = $this->countCruds();

        // Format initial values

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        $table_name = TableNameFormatter::formatTableName($model_name);

        $model_label = FormatModelLabel::formatModelLabel($model_name);

        // We send along the arrays for the formconfig types we need to create

        $this->assembleFormConfigSeeds->createFormConfigs($model_label, $crud_id, $booleans, $texts, $numbers, $selects, $files); 


    }

    public function makeCrudSeed($request)
    {

        // Format initial values

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        $table_name = TableNameFormatter::formatTableName($model_name);

        $model_label = FormatModelLabel::formatModelLabel($model_name);

        $crud_tokens = ['MODELLABEL' => $model_label, 'TABLENAME' => $table_name];

        $this->saveCrudSeed($crud_tokens);

    }

    public function saveCrudSeed($crud_tokens)
    {

        // files we need

        $crud_seed_template_path = base_path() . '/app/CodeGenerator/Templates/Seeds/crud-seed.txt';

        $crud_seed_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // assemble template

        $content = AssembleTemplateService::assembleTemplate($crud_seed_template_path, $crud_tokens);

        // get contents of existing crud seed file

        $existing_file_content = file_get_contents($crud_seed_file);

        // Find the last occurrence of "//" in the existing content

        $lastCommentPosition = strrpos($existing_file_content, '//');

        // Find the end of the line after the last "//"
    
        $endOfLinePosition = strpos($existing_file_content, PHP_EOL, $lastCommentPosition);

        // Append $content on a new line after the end of the line
    
        $new_content = substr_replace($existing_file_content, PHP_EOL . $content . PHP_EOL, $endOfLinePosition + strlen(PHP_EOL), 0);
    
        // Write the modified content back to the file
    
        file_put_contents($crud_seed_file, $new_content);


    }

    public function countCruds()
    {

        // set path to file

        $file_path = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // Open the file for reading

        $file_handle = fopen($file_path, 'r');


        // Initialize the line count

        $line_count = 0;


        // Loop through each line in the file

        while (($line = fgets($file_handle)) !== false) {
    
            // Check if the line contains both "//" and "begin"
    
            if (strpos($line, '//') !== false && strpos($line, 'begin') !== false) {
        
                $line_count++;
            }
        }

        // Close the file handle

        fclose($file_handle);

        return $line_count;

    }


}