<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class MakeProjectRoleService
{

    public $writer;
    public $findOrMakeDirectoryService;


    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;


    }

    public function makeRoleSystem()
    {

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // make folders

        $this->makeFolders();

        // write the files

        $this->writeFiles($files);


    }

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function makeFolders()
    {

        // make role folders

        $role_controller_folder = base_path() . '/app/Http/Controllers/Admin/Roles';

        $user_role_controller_folder = base_path() . '/app/Http/Controllers/Admin/UserRolesManagement';

        $folders = [$role_controller_folder, $user_role_controller_folder];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }



    }

    public function setDestinationFilesAndTemplates()
    {


        // models

        $role_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/project-role-model.txt';
        $role_model_file = base_path() . '/app/Models/Role.php';

        $user_role_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/project-user-role-model.txt';
        $user_role_model_file = base_path() . '/app/Models/UserRole.php';

        // controllers

        $roles_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/roles-controller.txt';
        $roles_controller_file = base_path() . '/app/Http/Controllers/Admin/Roles/RolesController.php';

        $user_roles_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/user-roles-management-controller.txt';
        $user_roles_controller_file = base_path() . '/app/Http/Controllers/Admin/UserRolesManagement/UserRolesManagementController.php';

        // migrations

        $roles_migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/roles-migration.txt';
        $roles_migration_file = base_path() . '/database/migrations/2023_11_06_000000_create_roles_table.php';

        $user_roles_migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/user-roles-migration.txt';
        $user_roles_migration_file = base_path() . '/database/migrations/2023_11_09_000000_create_user_roles_table.php';

        // seeds

        $role_seeds_template = base_path() . '/app/CodeGenerator/Templates/Projects/Seeds/role-seeds.txt';
        $role_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/RolesSeederController.php';

        $files = [

            $role_model_template => $role_model_file,
            $user_role_model_template => $user_role_model_file,
            $roles_controller_template => $roles_controller_file,
            $user_roles_controller_template => $user_roles_controller_file,
            $roles_migration_template => $roles_migration_file,
            $user_roles_migration_template => $user_roles_migration_file,
            $role_seeds_template => $role_seeds_file

        ];

        return $files;

    }

   


}