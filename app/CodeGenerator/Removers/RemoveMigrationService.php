<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Formatters\TableNameFormatter;

class RemoveMigrationService
{

    public function removeMigration($request)
    {

        $model_name = $request->get('model');

        $table_name = TableNameFormatter::formatTableName($model_name);

        $file = 'create_' . $table_name  . '_table';

        $migrations = scandir(base_path('database/migrations')) ;

        foreach ($migrations as $migration){

            if( str_contains($migration, $file)){

                $file = $migration;
            }

        }

        $file_path = base_path('database/migrations/') . $file;

        if ( file_exists($file_path) ) {

            unlink($file_path);


        }

        

    }



}