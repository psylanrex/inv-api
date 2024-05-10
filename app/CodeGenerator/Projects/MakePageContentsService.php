<?php

namespace App\CodeGenerator\Projects;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Seeds\FoundationSeedService;

class MakePageContentsService
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

    public function makePageContents()
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

            'model' => 'PageContents',
            'controller_type' => 'Admin',
            'controller_folder' => 'PageContents',
            'column_1_name' => 'page_content_name',
            'column_1_type' => 'string-unique',
            'column_2_name' => 'page_content_body',
            'column_2_type' => 'string'

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

        // make page_contents folders

        $page_contents_controller_folder = base_path() . '/app/Http/Controllers/Admin/PageContents';
        $contents_controller_folder = base_path() . '/app/Http/Controllers/User/Contents';

        $app_folder = base_path() . '/app/PageContents';

        $folders = [$page_contents_controller_folder, $contents_controller_folder, $app_folder];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }

    public function setDestinationFilesAndTemplates()
    {

        // models

        $page_contents_model_template = base_path() . '/app/CodeGenerator/Templates/PageContents/page-content-model.txt';
        $page_contents_model_file = base_path() . '/app/Models/PageContent.php';

        // controllers

        $page_contents_controller_template = base_path() . '/app/CodeGenerator/Templates/PageContents/page-contents-controller.txt';
        $page_contents_controller_file = base_path() . '/app/Http/Controllers/Admin/PageContents/PageContentsController.php';

        $contents_controller_template = base_path() . '/app/CodeGenerator/Templates/PageContents/contents-controller.txt';
        $contents_controller_file = base_path() . '/app/Http/Controllers/User/Contents/ContentsController.php';


        // migrations

        $page_contents_migration_template = base_path() . '/app/CodeGenerator/Templates/PageContents/page-contents-migration.txt';
        $page_contents_migration_file = base_path() . '/database/migrations/2023_12_01_213703_create_page_contents_table.php';

        // seeds

        $page_contents_seeds_template = base_path() . '/app/CodeGenerator/Templates/PageContents/seed.txt';
        $page_contents_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/PageContentsSeederController.php';

        // content files

        $about_template = base_path() . '/app/CodeGenerator/Templates/PageContents/about.txt';
        $about_file = base_path() . '/app/PageContents/about.txt';

        $privacy_template = base_path() . '/app/CodeGenerator/Templates/PageContents/privacy.txt';
        $privacy_file = base_path() . '/app/PageContents/privacy.txt';

        $terms_template = base_path() . '/app/CodeGenerator/Templates/PageContents/terms.txt';
        $terms_file = base_path() . '/app/PageContents/terms.txt';

        $files = [

            $page_contents_model_template => $page_contents_model_file,

            $page_contents_controller_template => $page_contents_controller_file,

            $contents_controller_template => $contents_controller_file,

            $page_contents_migration_template => $page_contents_migration_file,

            $page_contents_seeds_template => $page_contents_seeds_file, 

            $about_template => $about_file,

            $privacy_template => $privacy_file,

            $terms_template => $terms_file      

        ];

        return $files;

    }

}