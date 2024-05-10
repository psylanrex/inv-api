<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveFileService;
use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFormConfigSeedService;
use App\CodeGenerator\Removers\RemoveCrudSeedService;
use App\CodeGenerator\Removers\RemoveRouteService;
use App\CodeGenerator\Removers\RemoveModelFromRunSeedsService;


class RemovePageContentsService
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

    public function removePageContents()
    {

        $this->removePageContentFolders();

        $this->removePageContentFiles();

        $this->removeFormConfig();

        $this->removeCrudSeed();

        $this->removeRoutes();

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('PageContent');

        return ['message' => 'PageContent System gone...'];

    }

    Public function removeRoutes()
    {

        // the token system in removeRouteService requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'PageContent',
            'controller_type' => 'Admin',
            'controller_folder' => 'PageContents',
            'column_1_name' => NULL

        ]);


        $this->removeRouteService->removeRoute($request);


    }


    public function removeFormConfig()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeFormConfigSeedService->removeFormConfigSeed('PageContent');

        }      

    }

    public function removeCrudSeed()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeCrudSeedService->removeCrudSeed('PageContent');

        }      

    }   

    public function removePageContentFolders()
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

    public function removePageContentFiles()
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

        $page_content = base_path() . '/app/Models/PageContent.php';
        

        // seeds

        $page_contents_seeds = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/PageContentsSeederController.php';
        

        // migrations

        $create_page_contents = base_path() . '/database/migrations/2023_12_01_213703_create_page_contents_table.php';
        

        // files array

        $files = [

            $page_content,
            $page_contents_seeds,
            $create_page_contents

           
        ];

        return $files;

    }

    public function setFolderPaths()
    {

        // controller folders

        $page_contents_folder = base_path() . '/app/Http/Controllers/Admin/PageContents';

        $contents_folder = base_path() . '/app/Http/Controllers/User/Contents';

        // folder with content files

        $page_contents_folder_app_folder = base_path() . '/app/PageContents';

        $folders = [

            $page_contents_folder,
            $page_contents_folder_app_folder

        ];

        return $folders;

    }

}