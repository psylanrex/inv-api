<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveFileService;
use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFormConfigSeedService;
use App\CodeGenerator\Removers\RemoveCrudSeedService;
use App\CodeGenerator\Removers\RemoveRouteService;
use App\CodeGenerator\Removers\RemoveModelFromRunSeedsService;


class RemoveFaqsService
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

    public function removeFaqs()
    {

        $this->removeFaqFolders();

        $this->removeFaqFiles();

        $this->removeFormConfig();

        $this->removeCrudSeed();

        $this->removeRoutes();

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('Faq');

        return ['message' => 'Faq System gone...'];

    }

    Public function removeRoutes()
    {

        // the token system in removeRouteService requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'Faq',
            'controller_type' => 'Admin',
            'controller_folder' => 'Faqs',
            'column_1_name' => NULL

        ]);


        $this->removeRouteService->removeRoute($request);


    }


    public function removeFormConfig()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeFormConfigSeedService->removeFormConfigSeed('Faq');

        }      

    }

    public function removeCrudSeed()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeCrudSeedService->removeCrudSeed('Faq');

        }      

    }   

    public function removeFaqFolders()
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

    public function removeFaqFiles()
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

        $faq = base_path() . '/app/Models/Faq.php';
        

        // seeds

        $faqs_seeds = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FaqsSeederController.php';
        

        // migrations

        $create_faqs = base_path() . '/database/migrations/2023_12_01_212027_create_faqs_table.php';
        

        // files array

        $files = [

            $faq,
            $faqs_seeds,
            $create_faqs

           
        ];

        return $files;

    }

    public function setFolderPaths()
    {

        // controller folders

        $faq_folder = base_path() . '/app/Http/Controllers/Admin/Faqs';


        $folders = [

            $faq_folder,

        ];

        return $folders;

    }

}