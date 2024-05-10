<?php

namespace App\CodeGenerator\Assemblers;

class AssembleFormConfigSeedsService
{

    public function createFormConfigs($model_label, $crud_id, $booleans, $texts, $numbers, $selects, $files)
    {

        // $booleans, $texts, $numbers, $selects, $files are arrays holding the names of the form configs we need to create
        // example: a column like status_id will be in the $selects array because ultimately we want the front end form 
        // to have a dropdown list of statuses. A column like status_name will be in $texts because it's a text input on 
        // the front end.

        // The form configs are are created and saved to a tempfile, then the entire block of 
        // form configs is added to the form config seeder file.
        // hint: when looking at the function signature, $files can be confusing. This is an array of column
        // names to be formatted as file upload config, not actual files.


        // set values

        $file = base_path('app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php');

        $crud_id_token = $crud_id;

        $this->createTexts($texts, $file, $crud_id_token);

        $this->createSelects($selects, $file, $crud_id_token);

        $this->createNumbers($numbers, $file, $crud_id_token);

        $this->createBooleans($booleans, $file, $crud_id_token);

        $this->createFiles($files, $file, $crud_id_token);

        $this->storeConfig($file, $model_label);

    }


    public function createBooleans($booleans, $file, $crud_id_token)
    {

        // create a form config for each name in the $booleans array

        foreach ($booleans as $boolean) 
        {
            $boolean_name = $boolean;

            $boolean_label = $this->formatTextAndNumberLabel($boolean_name);

            $template = "\tFormConfig::create([

                'crud_id' => {$crud_id_token},
                'name' => '{$boolean_name}',
                'type' => 'boolean',
                'label' => '{$boolean_label}',
                'required' => 1,
                'max_length' => 500
    
        ]);";

            // we store the config in a temp file

            $this->storeTempConfig($file, $template);

        }

    }


    public function createNumbers($numbers, $file, $crud_id_token)
    {

        foreach ($numbers as $number) 
        {
            $number_name = $number;

            $number_label = $this->formatTextAndNumberLabel($number_name);

            $template = "\tFormConfig::create([

                'crud_id' => {$crud_id_token},
                'name' => '{$number_name}',
                'type' => 'number',
                'label' => '{$number_label}',
                'required' => 1,
                'max_length' => 50
    
        ]);";

            $this->storeTempConfig($file, $template);

        }

    }

    public function createTexts($texts, $file, $crud_id_token)
    {

        // create a form config for each name in the $texts array

        foreach ($texts as $text) 
        {
            $text_name = $text;

            $text_label = $this->formatTextAndNumberLabel($text_name);

            $template = "\tFormConfig::create([

                'crud_id' => {$crud_id_token},
                'name' => '{$text_name}',
                'type' => 'text',
                'label' => '{$text_label}',
                'required' => 1,
                'max_length' => 50
    
        ]);";

            $this->storeTempConfig($file, $template);

        }

    }

    public function formatTextAndNumberLabel($value_name)
    {

        // using 'value' because this is for both numbers and text

        $value_label = str_replace('_', ' ', $value_name);

        return ucwords($value_label);


    }

    public function createSelects($selects, $file, $crud_id_token) 
    {
// create a form config for each name in the $selects array
        

        foreach ($selects as $select) 
        {
            $select_name = $select;

            $select_label = $this->formatSelectLabel($select_name);

            $template = "\tFormConfig::create([

                'crud_id' => {$crud_id_token},
                'name' => '{$select_name}',
                'type' => 'select',
                'label' => '{$select_label}',
                'required' => 1,
                'max_length' => 50
    
        ]);";

            $this->storeTempConfig($file, $template);

        }

    }

    public function createFiles($files, $file, $crud_id_token)
    {
        // create a form config for each name in the $files array

        foreach ($files as $upload) 
        {
            $upload_name = $upload;

            $upload_label = $this->formatTextAndNumberLabel($upload_name);

            $template = "\tFormConfig::create([

                'crud_id' => {$crud_id_token},
                'name' => '{$upload_name}',
                'type' => 'file',
                'label' => '{$upload_label}',
                'required' => 0,
                'max_length' => 0
    
        ]);";

            $this->storeTempConfig($file, $template);

        }

    }

    public function formatSelectLabel($select_name)
    {

        $select_label = str_replace('_', ' ', $select_name);

        $select_label = ucwords($select_label);

        $select_label = str_replace('Id', '', $select_label);

        return rtrim($select_label);

    }

    public function storeTempConfig($file, $template)
    {

        // tempfile

        $tempfile = base_path() . '/app/CodeGenerator/Seeds/temp.txt';

        // get the file contents

        $contents = file_get_contents($tempfile);
 
        //create a new file contents from the array pieces plus the new $template
        // it uses the closing bracket of the function to arrange in the new form configs

        $template = $contents . PHP_EOL . $template . PHP_EOL;

        // open, write and close

        $handle = fopen($tempfile, 'w');

        fwrite($handle, $template);

        fclose($handle);


    }

    public function storeConfig($file, $model_label)
    {

        // get the formatted formconfigs from the temp file

        $tempfile = base_path() . '/app/CodeGenerator/Seeds/temp.txt';

        // get the file contents

        $contents = file_get_contents($file);

        $form_configs = file_get_contents($tempfile);

        // Define markers to wrap the new configs

        $new_line_above = "// {$model_label} begin";

        $new_line_below = "// {$model_label} end";

        $form_configs = <<<EOT

        $new_line_above
        $form_configs
        $new_line_below
EOT;

        // divide into array parts on the separator

        $classParts = explode('}', $contents, 3);
        
        //create a new file contents from the array pieces plus the new $template
        // it uses the closing bracket of the function to arrange in the new form configs

        $template = $classParts[0] . "\t" . $form_configs . PHP_EOL . PHP_EOL . "\t" . "}"  . $classParts[1] . "}" .  $classParts[2];

        // open, write and close

        $handle = fopen($file, 'w');

        fwrite($handle, $template);

        fclose($handle);

        // clean up tempfile

        // Open the file in write mode and truncate it

        $tempFileHandle = fopen($tempfile, 'w');

        // Close the file handle

        fclose($tempFileHandle);


    }


}