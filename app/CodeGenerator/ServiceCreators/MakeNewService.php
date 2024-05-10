<?php

namespace App\CodeGenerator\ServiceCreators;

use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Assemblers\AssembleTemplateService;

class MakeNewService
{

    public $findOrMakeDirectoryService;
    public $assembleTemplateService;
    public $parent_folder_name;
    public $service_folder_name;
    public $parent_folder_path;
    public $service_folder_path;
    public $service_file_name;
    public $destination_file_path;
    public $tokens;


    public function __construct()
    {

        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;
        $this->assembleTemplateService = new AssembleTemplateService;

    }

    public function makeNewService($request)
    {

        $request->validate([

            'service_folder_name' => 'string|required',
            'parent_folder_name' => 'string|required',
            'controller_path' => 'nullable|string',
            'service_name' => 'string|required',
            'method_name' => 'string|required'

        ]);

        $this->setFolderPaths($request);

        $this->setDestinationPath($request);

        $this->setTokens($request);

        $this->makeFolders($request);

        $this->writeFile($request);

        return 'What a fantastic way to start a new service!';


    }

    public function writeFile()
    {

        $template_file_path = base_path() . '/app/CodeGenerator/Templates/Services/service.txt';

        // use assemble template service to read and format content

        $content = AssembleTemplateService::assembleTemplate($template_file_path, $this->tokens);    

        // Write the content to the file

        file_put_contents($this->destination_file_path, $content);


    }

    public function setTokens($request)
    {

        if ( $this->parent_folder_name == 'Services' ) {

            $this->namespace = "namespace App\Services\\" . $this->service_folder_name;

        } else {

            $this->namespace = "namespace App\Services\\" . $this->parent_folder_name ."\\" . $this->service_folder_name;


        }

        $this->tokens = [

            'NAMESPACE' => $this->namespace,
            'SERVICENAME' => $request->get('service_name'),
            'METHODNAME' => $request->get('method_name')

        ];

       return $this->tokens;

    }

    public function setDestinationPath($request)
    {

        $this->service_file_name = $request->get('service_name') . '.php';

        if ( $this->parent_folder_name == 'Services' ) {

            $this->destination_file_path = base_path() . '/app/' 
                                                       . $this->parent_folder_name 
                                                       . '/' 
                                                       . $this->service_folder_name
                                                       . '/' 
                                                       . $this->service_file_name;


        } else {

            $this->destination_file_path = base_path() . '/app/Services/' 
                                                       . $this->parent_folder_name 
                                                       . '/' 
                                                       . $this->service_folder_name
                                                       . '/' 
                                                       . $this->service_file_name;

        }

    }

    public function setFolderPaths($request)
    {

        $this->parent_folder_name = $request->get('parent_folder_name');
        $this->service_folder_name = $request->get('service_folder_name');
        

        if ( $this->parent_folder_name == 'Services' ) {

            $this->parent_folder_path = base_path() . "/app/Services";
            $this->service_folder_path = base_path() . "/app/Services/{$this->service_folder_name}";


        } else {


            $this->parent_folder_path = base_path() . "/app/Services/{$this->parent_folder_name}";
            $this->service_folder_path = base_path() . "/app/Services/{$this->parent_folder_name}/{$this->service_folder_name}";

        }

    }

    public function makeFolders($request)
    {

        if ( $this->parent_folder_name == 'Services' ) {


            $this->findOrMakeDirectoryService->findOrMakeDirectory($this->service_folder_path);


        } else {


            $this->findOrMakeDirectoryService->findOrMakeDirectory($this->parent_folder_path);
            $this->findOrMakeDirectoryService->findOrMakeDirectory($this->service_folder_path);

        }

    }

}