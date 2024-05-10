<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Writers\Writer;

class MakeProjectAuthService
{

    public $writer;


    public function __construct()
    {

        $this->writer = new Writer;


    }

    public function makeAuthSystem()
    {

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // write the files

        $this->writeFiles($files);


    }

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function setDestinationFilesAndTemplates()
    {


        // auth controller

        $auth_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/auth-controller.txt';
        $auth_controller_file = base_path() . '/app/Http/Controllers/Auth/AuthController.php';

        // user verification

        $user_verification_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/user-verification-controller.txt';
        $user_verification_controller_file = base_path() . '/app/Http/Controllers/Auth/UserVerificationController.php';

        $user_verification_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/user-verification-model.txt';
        $user_verification_model_file = base_path() . '/app/Models/UserVerification.php';

        $user_verification_migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/user-verification-migration.txt';
        $user_verification_migration_file = base_path() . '/database/migrations/2023_11_02_000000_create_user_verifications_table.php'; 
        
        // password reset

        $password_reset_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/password-reset-token-controller.txt';
        $password_reset_controller_file = base_path() . '/app/Http/Controllers/Auth/PasswordResetTokenController.php';

        $password_reset_token_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/password-reset-token-model.txt';
        $password_reset_token_model_file = base_path() . '/app/Models/PasswordResetToken.php';

        // registration request

        $registration_request_template = base_path() . '/app/CodeGenerator/Templates/Projects/Requests/registration-request.txt';
        $registration_request_file = base_path() . '/app/Http/Requests/RegistrationRequest.php';

        // login service

        $login_service_template = base_path() . '/app/CodeGenerator/Templates/Projects/Services/login-service.txt';
        $login_service_file = base_path() . '/app/Services/Auth/LoginService.php';

        // profanity filter

        $profanity_filter_service_template = base_path() . '/app/CodeGenerator/Templates/Projects/Services/profanity-filter-service.txt';
        $profanity_filter_service_file = base_path() . '/app/Services/Auth/ProfanityFilterService.php';

        // profanity not allowed rule

        $profanity_rule_template = base_path() . '/app/CodeGenerator/Templates/Projects/rules/profanity-not-allowed.txt';
        $profanity_rule_file = base_path() . '/app/Rules/ProfanityNotAllowed.php';

        // registration service

        $registration_service_template = base_path() . '/app/CodeGenerator/Templates/Projects/Services/registration-service.txt';
        $registration_service_file = base_path() . '/app/Services/Auth/RegistrationService.php';


        $files = [

                $auth_controller_template => $auth_controller_file, 
                $user_verification_controller_template => $user_verification_controller_file,
                $user_verification_model_template => $user_verification_model_file,
                $user_verification_migration_template => $user_verification_migration_file,
                $password_reset_controller_template => $password_reset_controller_file,
                $password_reset_token_model_template => $password_reset_token_model_file,
                $registration_request_template => $registration_request_file,
                $login_service_template => $login_service_file,
                $profanity_filter_service_template => $profanity_filter_service_file,
                $profanity_rule_template => $profanity_rule_file,
                $registration_service_template => $registration_service_file

                ];

        return $files;



    }

   


}