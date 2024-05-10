<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveFileService;
use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFormConfigSeedService;
use App\CodeGenerator\Removers\RemoveCrudSeedService;
use App\CodeGenerator\Removers\RemoveRouteService;
use App\CodeGenerator\Removers\RemoveModelFromRunSeedsService;


class RemoveSupportSystemService
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

    public function removeSupportSystem()
    {

        $this->removeSupportFolders();

        $this->removeSupportFiles();

        $this->removeFormConfig();

        $this->removeCrudSeed();

        $this->removeRoutes();

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('SupportTopic');

        return ['message' => 'Support System gone...'];

    }

    Public function removeRoutes()
    {

        // the token system in removeRouteService requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'SupportTopic',
            'controller_type' => 'Admin',
            'controller_folder' => 'SupportTopics',
            'column_1_name' => NULL

        ]);


        $this->removeRouteService->removeRoute($request);

        // Support routes and use statement do not follow convention 
        // and must be removed manually.


    }



    public function removeFormConfig()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeFormConfigSeedService->removeFormConfigSeed('SupportTopic');

        }      

    }

    public function removeCrudSeed()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeCrudSeedService->removeCrudSeed('SupportTopic');

        }      

    }   

    public function removeSupportFolders()
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

    public function removeSupportFiles()
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

        // services are removed through the remove folder function


        // models

        $support_ticket = base_path() . '/app/Models/SupportTicket.php';
        $support_topic = base_path() . '/app/Models/SupportTopic.php';
        $ticket_response = base_path() . '/app/Models/TicketResponse.php';

        // seeds

        $support_topic_seeds = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/SupportTopicsSeederController.php';

        // migrations

        $create_support_topics = base_path() . '/database/migrations/2023_11_28_220443_create_support_topics_table.php';
        $create_support_tickets = base_path() . '/database/migrations/2023_11_28_223324_create_support_tickets_table.php';
        $create_ticket_responses = base_path() . '/database/migrations/2023_11_28_223606_create_ticket_responses_table.php';

        $files = [

            $support_ticket,
            $support_topic,
            $ticket_response,
            $support_topic_seeds,
            $create_support_topics,
            $create_support_tickets,
            $create_ticket_responses

        ];

        return $files;

    }

    public function setFolderPaths()
    {

        // services - will remove the Support folder and all its files

        $support_services = base_path() . '/app/Services/Support';

        // Queries

        $support_queries = base_path() . '/app/Queries/Support';

        // controller folders

        $support_folder = base_path() . '/app/Http/Controllers/Admin/Support';

        $user_support_folder = base_path() . '/app/Http/Controllers/User/Support';

        $support_topics_folder = base_path() . '/app/Http/Controllers/Admin/SupportTopics';


        $folders = [

            $support_services,
            $support_folder,
            $user_support_folder,
            $support_topics_folder,
            $support_queries


        ];

        return $folders;

    }

}