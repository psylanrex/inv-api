<?php

namespace App\CodeGenerator\Crons;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Writers\ConsoleKernelWriter;
use App\CodeGenerator\Assemblers\AssembleTemplateService;

class MakeCronService
{
    public $tokens;
    public $consoleKernelWriter;
    public $assembleTemplateService;
    public $command_name;
    public $signature;
    public $description;
    public $handler_name;
    public $handler_method_name;
    public $interval;

    public function __construct()
    {

        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;
        $this->consoleKernelWriter = new ConsoleKernelWriter;
        $this->assembleTemplateService = new AssembleTemplateService;

    }

    public function makeCron($request)
    {   

        // set class properties with request values

        $this->setClassProperties($request);

        // set tokens

        $this->setTokens();

        // Make directory

        $this->makeCommandDirectory();

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // write the files

        $this->writeFiles($files);

        // Add line to Kernel for schedule of command

        $this->addLineToKernel($request);

        return 'Yay! You made a cron. Go setup your handler file.';

    }
    public function makeCommandDirectory()
    {

        $file_path = base_path() . '/app/Console/Commands';

        $this->findOrMakeDirectoryService->findOrMakeDirectory($file_path);


    }

    public function setClassProperties($request)
    {

        $this->command_name = $request->get('command_name');
        $this->signature = $request->get('signature');
        $this->description = $request->get('description');
        $this->handler_name = $request->get('handler_name');
        $this->handler_method_name = $request->get('handler_method_name');
        $this->interval = $request->get('interval');

    }

    public function addLineToKernel($request)
    {

        $command_signature = $request->get('signature');

        $interval = $request->get('interval');

        $line = '// $schedule->command(' . $command_signature . ')->' . $interval .'()->onOneServer();';

        $this->consoleKernelWriter->addLineToKernel($line);     

    }

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            // use assemble template service to read and format content

            $content = AssembleTemplateService::assembleTemplate($template_file, $this->tokens);

            // Write the content to the file

            file_put_contents($file_path, $content);

        }

    }

    public function setTokens()
    {

        // Tokens we need:

        $this->tokens = [

            'COMMAND_NAME' => $this->command_name,
            'SIGNATURE' => $this->signature,
            'DESCRIPTION' => $this->description,
            'HANDLER_NAME' => $this->handler_name,
            'HANDLER_METHOD_NAME' => $this->handler_method_name,
            'INTERVAL' => $this->interval

        ];

    }

    public function setDestinationFilesAndTemplates()
    {

        $command_name = $this->tokens['COMMAND_NAME'];

        $handler_name = $this->tokens['HANDLER_NAME'];

        // Command

        $command_template = base_path() . '/app/CodeGenerator/Templates/Crons/command.txt';
        $command_file = base_path() . "/app/Console/Commands/{$command_name}.php";

        // Handler 

        $handler_template = base_path() . '/app/CodeGenerator/Templates/Crons/handler.txt';
        $handler_file = base_path() . "/app/Services/Crons/Handlers/{$handler_name}.php";    

        $files = [

            $command_template => $command_file,
            $handler_template => $handler_file

        ];

        return $files;

    }

}