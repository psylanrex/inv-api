<?php

namespace App\CodeGenerator\Migrations;

use App\CodeGenerator\Formatters\TableNameFormatter;
use App\CodeGenerator\Formatters\FillableColumnsFormatter;
use App\CodeGenerator\Assemblers\AssembleMigrationTemplateService;
use App\CodeGenerator\Formatters\MigrationColumnFormatter;
use App\CodeGenerator\Formatters\MigrationIndexFormatter;

class MigrationService
{

    public function __construct()
    {

        $this->migrationColumnFormatter = new MigrationColumnFormatter;
        $this->migrationIndexFormatter = new MigrationIndexFormatter;

    }


    public function makeMigration($request)
    {

        // Format table name

        $model_name = $request->get('model');

        $table_name = TableNameFormatter::formatTableName($model_name);


        // base path

        $base_path = base_path();

        // get the file path of the template

        $template_file = $base_path . '/app/CodeGenerator/Templates/Foundations/' . 'migration.txt';


        // format columns to include in migration

        $columns = $this->migrationColumnFormatter->formatColumns($request);

        // define the tokens

        $tokens = ['TABLENAME' => $table_name, 'COLUMNS' => $columns];

        // format indexes for relevant columns

        $indexes = $this->migrationIndexFormatter->formatIndexes($request, $tokens);


        

        // use assemble template service to read and format content

        AssembleMigrationTemplateService::assembleTemplate($template_file, $tokens, $table_name);

        

    }





}