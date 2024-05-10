<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class MakeProjectFoldersService
{

    public $findOrMakeDirectoryService;

    public function __construct()
    {

        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;

    }

    public function makeProjectFolders()
    {

        // make project folders: Utilities, Services, Auth folders in controllers, Auth folders in services

        $utilities_folder = base_path() . '/app/Utilities';

        $services_folder = base_path() . '/app/Services';

        $queries_folder = base_path() . '/app/Queries';

        $rules_folder = base_path() . '/app/Rules';

        $requests_folder = base_path() . '/app/Http/Requests';

        $auth_controller_folder = base_path() . '/app/Http/Controllers/Auth';

        $auth_services_folder = base_path() . '/app/Services/Auth';

        // $forms_services_folder = base_path() . '/app/Services/Forms';

        $admin_folder = base_path() . '/app/Http/Controllers/Admin';

        $dev_folder = base_path() . '/app/Http/Controllers/Admin/Dev';

        // $seeders_folder = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders';

        // $page_contents = base_path() . '/app/PageContents';

        $folders = [$utilities_folder, 
                    $services_folder, 
                    $auth_controller_folder, 
                    $auth_services_folder, 
                    $queries_folder,
                    $requests_folder,
                    $rules_folder,
                    // $forms_services_folder,
                    $admin_folder,
                    $dev_folder,
                    // $seeders_folder,
                    // $page_contents
                ];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }

}