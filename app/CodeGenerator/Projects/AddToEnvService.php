<?php

namespace App\CodeGenerator\Projects;

class AddToEnvService
{

    public function addToEnv()
    {

        $this->addAllowSeedsParameter();

        $this->setMailTrapEnv();

        return 'Congrats! I updated .env for you.';

        

    }

    public function addAllowSeedsParameter()
    {

        // path to .env

        $env_file_path = base_path() . '/.env';

        // Read the content from the file

        $original_env = file_get_contents($env_file_path);

        // The line after which you want to add a blank line

        $anchor_line = 'APP_URL=http://localhost';

        // The new line to add

        $new_line_to_add = "ALLOW_SEEDS=true";

        // Find the position of the anchor line in your content

        $position = strpos($original_env, $anchor_line);

        // Insert the new line after the anchor line, followed by a blank line
    
        $new_env = str_replace($anchor_line, $anchor_line . PHP_EOL . PHP_EOL . $new_line_to_add, $original_env);

        // Save the updated content back to the .env file
    
        file_put_contents($env_file_path, $new_env);

    }

    public function setMailTrapEnv()
    {

        $file = base_path() . '/.env';

        $template_file = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/mailtrap-env.txt';

        $content = file_get_contents($file);

        // Find the start and end positions of the block

        $start_position = strpos($content, 'MAIL_DRIVER="smtp"');

        $end_position = strpos($content, 'MAIL_FROM_NAME="${APP_NAME}"', $start_position);

        // Extract the block of code to be replaced
    
        $block_to_replace = substr($content, $start_position, $end_position - $start_position + strlen('MAIL_FROM_NAME="${APP_NAME}"'));

        // Read the content of the template
    
        $template = file_get_contents($template_file);

        // Replace the block in the content with the template
    
        $new_content = str_replace($block_to_replace, $template, $content);

        // Save the updated content back to the .env file
    
        file_put_contents($file, $new_content);

    }

}