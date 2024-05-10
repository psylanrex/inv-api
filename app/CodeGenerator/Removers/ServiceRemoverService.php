<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFileService;

class ServiceRemoverService
{

    public $removeDirectoryService;
    public $removeFileService;
    public $service_name;
    public $service_folder_name;
    public $parent_folder_name;
    public $remove_all_services_in_folder;
    public $folder_path;
    public $sub_folder_path;
    public $service_file_path;

    public function __construct()
    {

        $this->removeDirectoryService = new RemoveDirectoryService;
        $this->removeFileService = new RemoveFileService;

    }

    public function removeService($request)
    {

        $this->setValues($request);

        $this->removeFolders();

        $this->removeServiceFile();

        return "I removed your service for{$this->service_name}.";

    }

    public function removeServiceFile()
    {   

        $this->removeFileService->removeFile($this->service_file_path);

    }

    public function removeFolders()
    {

        if ( $this->remove_all_services_in_folder == 1 ) {

            if ( $this->parent_folder_name == 'Services' ) {

                $this->removeDirectoryService->removeDirectory($this->folder_path);

            } else {

                $this->removeDirectoryService->removeDirectory($this->folder_path);

                $this->removeDirectoryService->removeDirectory($this->folder_path);

            }

        }

    }

    public function setValues($request)
    {

        $this->service_name = $request->get('service_name');
        $this->service_folder_name = $request->get('service_folder_name');
        $this->parent_folder_name = $request->get('parent_folder_name');
        $this->remove_all_services_in_folder = $request->get('remove_all_services_in_folder');
        

        if ( $this->parent_folder_name == 'Services' ) {

            $this->folder_path = base_path() . '/app/Services/' . $this->service_folder_name;

            $this->service_file_path = base_path() . '/app/Services/' 
                                                   . $this->service_folder_name 
                                                   . '/' 
                                                   . $this->service_name 
                                                   . '.php';

        } else {

            $this->folder_path = base_path() . '/app/Services/' . $this->parent_folder_name;      

            $sub_folder_path = base_path() . '/app/Services/' . $this->parent_folder_name . '/' . $this->service_folder_name;

            $this->service_file_path = base_path() . '/app/Services/' 
                                                   . $this->parent_folder_name 
                                                   . '/' 
                                                   . $this->service_folder_name 
                                                   . '/'
                                                   . $this->service_name 
                                                   . '.php';

        }

    }

}