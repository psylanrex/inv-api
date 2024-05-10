<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFileService;
use App\CodeGenerator\Removers\RemoveLineFromFileService;
use App\CodeGenerator\Removers\RemoveSupportSystemService;
use App\CodeGenerator\Removers\RemoveProjectNavigationService;
use App\CodeGenerator\Removers\RemoveFaqsService;
use App\CodeGenerator\Removers\RemovePageContentsService;
use App\CodeGenerator\Removers\RemoveProjectCronService;

class RemoveProjectService
{

    public $removeDirectoryService;
    public $removeFileService;
    public $removeLineFromFileService;
    public $removeSupportSystemService;
    public $removeProjectNavigationService;
    public $removeFaqsService;
    public $removePageContentsService;
    public $removeProjectCronService;

    public function __construct()
    {

        $this->removeDirectoryService = new RemoveDirectoryService;
        $this->removeFileService = new RemoveFileService;
        $this->removeLineFromFileService = new RemoveLineFromFileService;
        $this->removeSupportSystemService = new RemoveSupportSystemService;
        $this->removeProjectNavigationService = new RemoveProjectNavigationService;
        $this->removeFaqsService = new RemoveFaqsService;
        $this->removePageContentsService = new RemovePageContentsService;
        $this->removeProjectCronService = new RemoveProjectCronService;

    }

    public function removeProject()
    {

        $this->removeProjectCronService->removeProjectCronService();

        $this->removePageContentsService->removePageContents();

        $this->removeFaqsService->removeFaqs();

        $this->removeProjectNavigationService->removeNavigation();

        $this->removeSupportSystemService->removeSupportSystem();

        $this->removeCoreProject();

        return 'We are turning back... Project Removed.';

    }

    public function removeCoreProject()
    {

        $this->removeFolders();

        $this->removeFiles();

        $this->removeLines();

    }

    public function removeLines()
    {

        //PHP can't have duplicate keys in an array
        //So I can't put the files in an array
        //because I'm using the Kernel file twice
        // so I have to call the removeLineFromFileService without using foreach
        // I'll define in pairs, then run each pair manually


        $kernel_file = base_path() . '/app/Http/Kernel.php';
        $kernel_line_one = "'isAdmin' => \\App\\Http\\Middleware\\IsAdmin::class,";

        $this->removeLineFromFileService->removeLine($kernel_file, $kernel_line_one); 

        $kernel_file = base_path() . '/app/Http/Kernel.php';
        $kernel_line_two = "'roles' => \\App\Http\\Middleware\\CheckRole::class,";

        $this->removeLineFromFileService->removeLine($kernel_file, $kernel_line_two); 

        $command_kernel_file = base_path() . '/app/Console/Kernel.php';
        $kernel_line_three = "\$schedule->command('app:trim-cron-logs')->everyMinute()->onOneServer();";

        $this->removeLineFromFileService->removeLine($command_kernel_file, $kernel_line_three); 

    }

    public function removeFolders()
    {
        $directories = $this->setFolderPaths();

        foreach ($directories as $directory) {

            $this->removeDirectoryService->removeDirectory($directory);

        }

    }

    public function removeFiles()
    {
        $files = $this->setFilePaths();

        foreach ($files as $file) {

            $this->removeFileService->removeFile($file);

        }

    }

    public function setLinesToRemove()
    {

        $contents = [];

        

        $contents = [$env_file => $env_line, $kernel_file => $kernel_line_one, $kernel_file => $kernel_line_two];

        return $contents;


    }

    public function setFilePaths()
    {

        // migrations

        $status_migration = base_path() . '/database/migrations/2023_11_22_000000_create_statuses_table.php';
        $user_roles_migration = base_path() . '/database/migrations/2023_11_09_000000_create_user_roles_table.php';
        $form_configs_migration = base_path() . '/database/migrations/2023_11_07_000000_create_form_configs_table.php';
        $roles_migration = base_path() . '/database/migrations/2023_11_06_000000_create_roles_table.php';
        $cruds_migration = base_path() . '/database/migrations/2023_11_06_000000_create_cruds_table.php';
        $user_verifications_migration = base_path() . '/database/migrations/2023_11_02_000000_create_user_verifications_table.php';

        // models

        $crud = base_path() . '/app/Models/Crud.php';
        $form_config = base_path() . '/app/Models/FormConfig.php';
        $role = base_path() . '/app/Models/Role.php';
        $status = base_path() . '/app/Models/Status.php';
        $user_role = base_path() . '/app/Models/UserRole.php';
        $user_verification = base_path() . '/app/Models/UserVerification.php';

        // middleware

        $is_admin = base_path() . '/app/Http/Middleware/IsAdmin.php';
        $check_role = base_path() . '/app/Http/Middleware/CheckRole.php';



        $files = [

            $status_migration,
            $user_roles_migration,
            $form_configs_migration,
            $roles_migration,
            $cruds_migration,
            $user_verifications_migration,
            $crud,
            $form_config,
            $role,
            $status,
            $user_role,
            $user_verification,
            $is_admin,
            $check_role

        ];

        return $files;

    }

    public function setFolderPaths()
    {

        $utilities = base_path() . '/app/Utilities';
        $services = base_path() . '/app/Services';
        $rules = base_path() . '/app/Rules';
        $queries = base_path() . '/app/Queries';
        $mail = base_path() . '/app/Mail';
        $views = base_path() . '/resources/views/emails';
        $admin_controllers = base_path() . '/app/Http/Controllers/Admin';
        $auth_controllers = base_path() . '/app/Http/Controllers/Auth';
        $requests = base_path() . '/app/Http/Requests';
        $page_contents = base_path() . '/app/PageContents';
        $code_generator_views = base_path() . '/resources/views/code-generators';

        $directories = [

            $utilities,
            $services,
            $rules,
            $queries,
            $mail,
            $views,
            $admin_controllers,
            $auth_controllers,
            $requests,
            $page_contents,
            $code_generator_views 

        ];

        return $directories;


    }




}