<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class BaseMailService
{

    public $writer;
    public $findOrMakeDirectory;


    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectory = new FindOrMakeDirectoryService;


    }

    public function makeBaseMailFiles()
    {

        $this->makeFolders();

        $this->makeFiles();


    }

    public function makeFolders()
    {

        $mail = base_path() . '/app/Mail';

        $views = base_path() . '/resources/views';

        $emails = base_path() . '/resources/views/emails';

        $verification = base_path() . '/resources/views/emails/verification';


        $folders = [$mail, $views, $emails, $verification];

        foreach ($folders as $folder) {


            $this->findOrMakeDirectory-> findOrMakeDirectory($folder);

        }


    }

    public function makeFiles()
    {

        $verify_email_template = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/verify-email.txt';
        $verify_email_file = base_path() . '/app/Mail/VerifyEmail.php';
        
        $forgot_password_email_template = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/forgot-password-email.txt';
        $forgot_password_email_file = base_path() . '/app/Mail/ForgotPasswordEmail.php';

        $verify_email_template_blade = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/verify-email-blade.txt';
        $verify_email_file_blade = base_path() . '/resources/views/emails/verification/verify-email.blade.php';
        
        $forgot_password_email_template_blade = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/forgot-password-email-blade.txt';
        $forgot_password_email_file_blade = base_path() . '/resources/views/emails/verification/forgot-password-email.blade.php';


        $files = [$verify_email_template => $verify_email_file, 
                  $forgot_password_email_template => $forgot_password_email_file,
                  $verify_email_template_blade => $verify_email_file_blade,
                  $forgot_password_email_template_blade => $forgot_password_email_file_blade];

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    


}