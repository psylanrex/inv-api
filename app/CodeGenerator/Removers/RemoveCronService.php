<?php

namespace App\CodeGenerator\Removers;

class RemoveCronService
{

    public static function removeCron($request)
    {

        $command_name = $request->get('command_name');
        $handler_name = $request->get('handler_name');

        $command_file = base_path() . "/app/Console/Commands/{$command_name}.php";
        $handler_file = base_path() . "/app/Services/Crons/Handlers/{$handler_name}.php";

        $files = [$command_file, $handler_file];

        foreach ($files as $file) {

            if ( file_exists($file) ) {

                unlink($file);
    
            }

        }

        return "{$command_name} cron has been deleted";
    }

}