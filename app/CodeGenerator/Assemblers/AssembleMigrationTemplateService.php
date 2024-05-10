<?php

namespace App\CodeGenerator\Assemblers;

use App\CodeGenerator\Tokens\InsertTokensService;
use App\CodeGenerator\Formatters\FormatMigrationFileName;
use App\CodeGenerator\Formatters\RemoveBlankLines;

class AssembleMigrationTemplateService
{

    public static function assembleTemplate($template_file, $tokens, $table_name)
    {


        $content = file_get_contents($template_file);


        $content = InsertTokensService::insertTokens($content, $tokens);

        
        // create migration filename

        $file_name = FormatMigrationFileName::formatMigrationFileName($table_name);
        
        // set path

        $file_path = base_path() . "/database/migrations/{$file_name}";

        // Write the content to the file

        file_put_contents($file_path, $content);

        $temp_file = base_path() . '/app/CodeGenerator/Migrations/Temp/' . 'temp.txt';

        $second_part_of_content = file_get_contents($temp_file);

        file_put_contents($file_path, $second_part_of_content, FILE_APPEND | LOCK_EX);

        // get rid of temp file

        unlink($temp_file);

        // remove blank lines

        $lines = [17, 18];

        RemoveBlankLines::removeLines($lines, $file_path);


    }



}