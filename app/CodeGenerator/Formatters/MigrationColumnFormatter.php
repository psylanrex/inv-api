<?php

namespace App\CodeGenerator\Formatters;

use Illuminate\Support\Arr;
use App\CodeGenerator\Formatters\FormatColumnsArray;

class MigrationColumnFormatter
{

    public function formatColumns($request)
    {

        // create temp file

        $file_path = base_path() . '/app/CodeGenerator/Migrations/Temp/' . 'temp.txt';

        // Create a blank text temp file to hold our dynamic tables columns
        
        touch($file_path);

        $columns = FormatColumnsArray::buildColumnsArray($request);

        $this->writeColumnsToTempFile($columns, $file_path);

        // Append part of themplate we need to complete columns
        // indexes and the rest of the migration template 
        // are added by the MigrationIndexFormatter, called by MigrationService.
        // indexes respresents a break point in the template

        $content = <<<'EOT'
            $table->timestamps();

            // Indexes 


EOT;

        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);

    }


    public function writeColumnsToTempFile($columns, $file_path)
    {


        foreach ($columns as $indexes => $rows) {


            foreach ( $rows as $column_name => $type ) {

                switch ($type) {


                    case 'string' :

                        $content =<<<'EOT'
                        $table->timestamps();
            
                        // Indexes 
                         
            
            EOT;
    
                        $content = "\t\t\t\$table->string('$column_name');" . PHP_EOL;
                        
                        // Add content to the file (append to the end)
    
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);

                        break;
    
                    case 'string-unique' :
    
                        $content = "\t\t\t\$table->string('$column_name')->unique();" . PHP_EOL;
                        
                        // Add content to the file (append to the end)
    
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);

                        break;
                        
                    case 'unsigned-integer' :
    
                        $content = "\t\t\t\$table->unsignedInteger('$column_name');" . PHP_EOL; 
    
                        // Add content to the file (append to the end)
    
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);

                        break;

                    case 'boolean' :
    
                        $content = "\t\t\t\$table->boolean('$column_name');" . PHP_EOL; 
        
                        // Add content to the file (append to the end)
        
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);
    
                        break;

                    case 'boolean-default' :
    
                        $content = "\t\t\t\$table->boolean('$column_name')->default(0);" . PHP_EOL; 
            
                        // Add content to the file (append to the end)
            
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);
        
                        break;
                        
                    case 'text' :
    
                        $content = "\t\t\t\$table->text('$column_name');" . PHP_EOL; 
                
                        // Add content to the file (append to the end)
                
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);
            
                        break;

                    case 'date-time' :
    
                        $content = "\t\t\t\$table->dateTime('$column_name');" . PHP_EOL; 
                
                        // Add content to the file (append to the end)
                
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);
            
                        break;
                        
                    default: 
    
                        $content = "\t\t\t\$table->string('$column_name');" . PHP_EOL; 
    
                        // Add content to the file (append to the end)
    
                        file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);
    
    
                }





            }

            


       }


    }


}