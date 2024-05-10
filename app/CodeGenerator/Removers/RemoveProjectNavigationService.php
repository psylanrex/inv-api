<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveFileService;
use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFormConfigSeedService;
use App\CodeGenerator\Removers\RemoveCrudSeedService;
use App\CodeGenerator\Removers\RemoveRouteService;
use App\CodeGenerator\Removers\RemoveModelFromRunSeedsService;


class RemoveProjectNavigationService
{

    public $removeDirectoryService;
    public $removeFileService;
    public $removeFormConfigSeedService;
    public $removeCrudSeedService;
    public $removeRouteService;
    public $removeModelFromRunSeedsService;

    public function __construct()
    {

        $this->removeDirectoryService = new RemoveDirectoryService;
        $this->removeFileService = new RemoveFileService;
        $this->removeFormConfigSeedService = new RemoveFormConfigSeedService;
        $this->removeCrudSeedService = new RemoveCrudSeedService;
        $this->removeRouteService = new RemoveRouteService;
        $this->removeModelFromRunSeedsService = new RemoveModelFromRunSeedsService;

    }

    public function removeNavigation()
    {

        $this->removeNavigationFolders();

        $this->removeNavigationFiles();

        $this->removeFormConfig();

        $this->removeCrudSeed();

        $this->removeRoutes();

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('NavHeading');

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('NavItem');

        return ['message' => 'Navigation System gone...'];

    }

    Public function removeRoutes()
    {

        // the token system in removeRouteService requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'NavHeading',
            'controller_type' => 'Admin',
            'controller_folder' => 'NavHeadings',
            'column_1_name' => NULL

        ]);


        $this->removeRouteService->removeRoute($request);

        $request2 = new Request;

        // add values to request

        $request2->merge([

            'model' => 'NavItem',
            'controller_type' => 'Admin',
            'controller_folder' => 'NavItems',
            'column_1_name' => NULL

        ]);

        $this->removeRouteService->removeRoute($request2);

        // Some Navigation routes and use statement do not follow convention 
        // and must be removed manually.

    }



    public function removeFormConfig()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeFormConfigSeedService->removeFormConfigSeed('NavHeading');

            $this->removeFormConfigSeedService->removeFormConfigSeed('NavItem');

        }      

    }

    public function removeCrudSeed()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeCrudSeedService->removeCrudSeed('NavHeading');

            $this->removeCrudSeedService->removeCrudSeed('NavItem');

        }      

    }   

    public function removeNavigationFolders()
    {

        $folders = $this->setFolderPaths();

        foreach ($folders as $folder) {

            // check to see if folder exists, it might already be gone from another remove process

            if ( ! is_dir($folder) ) {

                continue;

            }

            $this->removeDirectoryService->removeDirectory($folder);    

        }

    }

    public function removeNavigationFiles()
    {

        $files = $this->setFilePaths();

        foreach ($files as $file) {

            // check to see if file exists, it might already be gone from another remove process

            if ( ! file_exists($file) ) {

                continue;

            }

            $this->removeFileService->removeFile($file);

        }

    }

    public function setFilePaths()
    {

        // controllers are removed through the remove folder function

        // models

        $nav_heading = base_path() . '/app/Models/NavHeading.php';
        $nav_item = base_path() . '/app/Models/NavItem.php';
        

        // seeds

        $nav_heading_seeds = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/NavHeadingsSeederController.php';
        $nav_items_seeds = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/NavItemsSeederController.php';

        // migrations

        $create_nav_headings = base_path() . '/database/migrations/2023_11_30_210700_create_nav_headings_table.php';
        $create_nav_items = base_path() . '/database/migrations/2023_11_30_221231_create_nav_items_table.php';

        // files array

        $files = [

            $nav_heading,
            $nav_item,
            $nav_heading_seeds,
            $nav_items_seeds,
            $create_nav_headings,
            $create_nav_items      

        ];

        return $files;

    }

    public function setFolderPaths()
    {

        // controller folders

        $nav_heading_folder = base_path() . '/app/Http/Controllers/Admin/NavHeadings';

        $nav_item_folder = base_path() . '/app/Http/Controllers/Admin/NavItems';


        $folders = [

            $nav_heading_folder,
            $nav_item_folder

        ];

        return $folders;

    }

}