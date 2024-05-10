<?php

namespace App\CodeGenerator\Assemblers;

use App\CodeGenerator\Tokens\InsertTokensService;

class AssembleTemplateService
{

    public static function assembleTemplate($file, $tokens)
    {


        $content = file_get_contents($file);

        $content = InsertTokensService::insertTokens($content, $tokens);

        return $content;


    }


}