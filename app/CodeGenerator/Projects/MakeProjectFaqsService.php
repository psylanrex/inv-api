<?php

namespace App\CodeGenerator\Projects;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Seeds\FoundationSeedService;

class MakeProjectFaqsService
{

    public $writer;
    public $findOrMakeDirectoryService;
    public $foundationSeedService;


    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;
        $this->foundationSeedService = new FoundationSeedService;


    }

    public function makeFaqs()
    {

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // make folders

        $this->makeFolders();

        // add nav items and headings to crud seeds and form config seeds

        $this->makeSeedFiles(); 

        // write the files

        $this->writeFiles($files);


    }

    public function makeSeedFiles()
    {

        // we use FoundationSeedService to create crud seeds and form config seeds
        // There's a separate seed file that we use for model seeds

        // the token system in Foundation Seed service requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'Faq',
            'controller_type' => 'Admin',
            'controller_folder' => 'Faqs',
            'column_1_name' => 'faq_question',
            'column_1_type' => 'string-unique',
            'column_2_name' => 'faq_answer',
            'column_2_type' => 'string',
            'column_3_name' => 'support_topic_id',
            'column_3_type' => 'unsigned_integer',

        ]);

        // foundation seed service will make the crud and form config seeds for us

        $this->foundationSeedService->makeSeeds($request);

        

    }

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function makeFolders()
    {

        // make faqs folders

        $faqs_controller_folder = base_path() . '/app/Http/Controllers/Admin/Faqs';

        $folders = [$faqs_controller_folder];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }

    public function setDestinationFilesAndTemplates()
    {

        // models

        $faq_model_template = base_path() . '/app/CodeGenerator/Templates/Faqs/faq-model.txt';
        $faq_model_file = base_path() . '/app/Models/Faq.php';

        // controllers

        $faqs_controller_template = base_path() . '/app/CodeGenerator/Templates/Faqs/faqs-controller.txt';
        $faqs_controller_file = base_path() . '/app/Http/Controllers/Admin/Faqs/FaqsController.php';

        // migrations

        $faqs_migration_template = base_path() . '/app/CodeGenerator/Templates/Faqs/faqs-migration.txt';
        $faqs_migration_file = base_path() . '/database/migrations/2023_12_01_212027_create_faqs_table.php';

        // seeds

        $faqs_seeds_template = base_path() . '/app/CodeGenerator/Templates/Faqs/faqs-seeds.txt';
        $faqs_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FaqsSeederController.php';

        $files = [

            $faq_model_template => $faq_model_file,

            $faqs_controller_template => $faqs_controller_file,

            $faqs_migration_template => $faqs_migration_file,

            $faqs_seeds_template => $faqs_seeds_file 

        ];

        return $files;

    }

}