<?php

namespace App\CodeGenerator\Formatters;

use Illuminate\Support\Str;
use App\CodeGenerator\Tokens\InsertTokensService;

class MigrationIndexFormatter
{

    public function formatIndexes($request, $tokens)
    {

        $indexes = $this->buildIndexesArray($request);

        // get temp file

        $file_path = base_path() . '/app/CodeGenerator/Migrations/Temp/' . 'temp.txt';

        $this->writeIndexesToTempFile($indexes, $file_path);

        // Append part the rest of the template

        $content = <<<'EOT'

        });
    }

    /**
    * Reverse the migrations.
    */
    public function down(): void
    {
        Schema::dropIfExists(':::TABLENAME:::');
    }

};

EOT;

    $content = InsertTokensService::insertTokens($content, $tokens);

    file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);



    }

    public function writeIndexesToTempFile($indexes, $file_path)
    {

        foreach  ($indexes as $index) {

            $content = "\t\t\t\$table->index('$index');" . PHP_EOL;
                        
            // Add content to the file (append to the end)
    
            file_put_contents($file_path, $content, FILE_APPEND | LOCK_EX);

        }


    }

    public function buildIndexesArray($request)
    {


        $indexes = [];


        $column_1_name = $request->get('column_1_name');

        if ( Str::contains($column_1_name, '_id') ) {

            $indexes[] = $column_1_name;

        }




       if ( $request->filled('column_2_name') ) {

            $column_2_name = $request->get('column_2_name');


            if ( Str::contains($column_2_name, '_id') ) {

                $indexes[] = $column_2_name;

            }

       }

       if ( $request->filled('column_3_name') ) {

            $column_3_name = $request->get('column_3_name');


            if ( Str::contains($column_3_name, '_id') ) {

                $indexes[] = $column_3_name;

            }

       }

        if ( $request->filled('column_4_name') ) {

            $column_4_name = $request->get('column_4_name');


            if ( Str::contains($column_4_name, '_id') ) {

                $indexes[] = $column_4_name;

            }

        }

        if ( $request->filled('column_5_name') ) {

            $column_5_name = $request->get('column_5_name');


            if ( Str::contains($column_5_name, '_id') ) {

                $indexes[] = $column_5_name;

            }

        }

        if ( $request->filled('column_6_name') ) {

            $column_6_name = $request->get('column_6_name');


            if ( Str::contains($column_6_name, '_id') ) {

                $indexes[] = $column_6_name;

            }

        }

        if ( $request->filled('column_7_name') ) {

            $column_7_name = $request->get('column_7_name');


            if ( Str::contains($column_7_name, '_id') ) {

                $indexes[] = $column_7_name;

            }

        }

        if ( $request->filled('column_8_name') ) {

            $column_8_name = $request->get('column_8_name');


            if ( Str::contains($column_8_name, '_id') ) {

                $indexes[] = $column_8_name;

            }

        }

        if ( $request->filled('column_9_name') ) {

            $column_9_name = $request->get('column_9_name');


            if ( Str::contains($column_9_name, '_id') ) {

                $indexes[] = $column_9_name;

            }

        }

        if ( $request->filled('column_10_name') ) {

            $column_10_name = $request->get('column_10_name');


            if ( Str::contains($column_10_name, '_id') ) {

                $indexes[] = $column_10_name;

            }

        }

        if ( $request->filled('column_11_name') ) {

            $column_11_name = $request->get('column_11_name');


            if ( Str::contains($column_11_name, '_id') ) {

                $indexes[] = $column_11_name;

            }

        }

        if ( $request->filled('column_12_name') ) {

            $column_12_name = $request->get('column_12_name');


            if ( Str::contains($column_12_name, '_id') ) {

                $indexes[] = $column_12_name;

            }

        }


        return $indexes;



    }


}