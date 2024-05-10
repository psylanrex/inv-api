<?php

namespace App\CodeGenerator\Models;

use App\CodeGenerator\Writers\Writer;

class ProjectUserModelService
{

    public $writer;

    public function __construct()
    {

        $this->writer = new Writer;


    }

    public function makeUserModelAndMigrationFiles($request)
    {

        // leaving request in for now incase we want choices later

        // write the user model

        $user_model_file_path = base_path() . '/app/Models/User.php';

        $user_model_template_file = base_path() . '/app/CodeGenerator/Templates/Projects/Models/project-user-model.txt';

        $this->writer->writeFromTemplate($user_model_template_file, $user_model_file_path);

        // write the user migration

        $user_migration_file_path = base_path() . '/database/migrations/2014_10_12_000000_create_users_table.php';

        $user_migration_template_file = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/user-migration.txt';

        $this->writer->writeFromTemplate($user_migration_template_file, $user_migration_file_path);

    }



}