<?php

namespace App\CodeGenerator\Tokens;

class InsertTokensService
{

    public static function insertTokens($content, Array $tokens)
    {

        foreach ($tokens as $string => $variable) {

            $content = str_replace(':::' . $string . ':::', $variable, $content);
        }

        return $content;


    }


}