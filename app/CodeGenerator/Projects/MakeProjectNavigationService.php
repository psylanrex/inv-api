<?php

namespace App\CodeGenerator\Projects;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Seeds\FoundationSeedService;

class MakeProjectNavigationService
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

    public function makeNavigationSystem()
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

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function makeSeedFiles()
    {

        // we use FoundationSeedService to create crud seeds and form config seeds
        // There's a separate seed file that we use for model seeds

        // the token system in Foundation Seed service requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'NavHeading',
            'controller_type' => 'Admin',
            'controller_folder' => 'NavHeadings',
            'column_1_name' => 'nav_heading_name',
            'column_1_type' => 'string-unique',

        ]);

        // foundation seed service will make the crud and form config seeds for us

        $this->foundationSeedService->makeSeeds($request);

        // the token system in Foundation Seed service requires a request.

        $request2 = new Request;

        // add values to request
        // we use FoundationSeedService to create crud seeds and form config seeds
        // There's a separate seed file that we use for model seeds

        $request2->merge([

            'model' => 'NavItem',
            'controller_type' => 'Admin',
            'controller_folder' => 'NavItems',
            'column_1_name' => 'nav_item_name',
            'column_1_type' => 'string-unique',
            'column_2_name' => 'nav_heading_id',
            'column_2_type' => 'unsigned-integer',
            'column_3_name' => 'nav_item_label',
            'column_3_type' => 'string',
            'column_4_name' => 'has_sub_items',
            'column_4_type' => 'boolean-default'

        ]);

        // foundation seed service will make the crud and form config seeds for us

        $this->foundationSeedService->makeSeeds($request2);

    }

    public function makeFolders()
    {

        // set paths into an array

        $nav_items_controller_folder = base_path() . '/app/Http/Controllers/Admin/NavItems';

        $nav_headings_controller_folder = base_path() . '/app/Http/Controllers/Admin/NavHeadings';

        $folders = [$nav_items_controller_folder, $nav_headings_controller_folder];

        // make role folders

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }

    public function setDestinationFilesAndTemplates()
    {


        // models

        $nav_heading_model_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Models/nav-heading-model.txt';
        $nav_heading_file = base_path() . '/app/Models/NavHeading.php';

        $nav_item_model_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Models/nav-item-model.txt';
        $nav_item_model_file = base_path() . '/app/Models/NavItem.php';

        // controllers

        $nav_headings_controller_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Controllers/nav-headings-controller.txt';
        $nav_headings_controller_file = base_path() . '/app/Http/Controllers/Admin/NavHeadings/NavHeadingsController.php';

        $nav_items_controller_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Controllers/nav-items-controller.txt';
        $nav_items_controller_file = base_path() . '/app/Http/Controllers/Admin/NavItems/NavItemsController.php';

        // migrations

        $nav_headings_migration_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Migrations/nav-headings-migration.txt';
        $nav_headings_migration_file = base_path() . '/database/migrations/2023_11_30_210700_create_nav_headings_table.php';

        $nav_items_migration_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Migrations/nav-items-migration.txt';
        $nav_items_migration_file = base_path() . '/database/migrations/2023_11_30_221231_create_nav_items_table.php';

        // seeds

        $nav_headings_seeds_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Seeds/nav-headings-seeder-controller.txt';
        $nav_headings_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/NavHeadingsSeederController.php';

        $nav_items_seeds_template = base_path() . '/app/CodeGenerator/Templates/Navigation/Seeds/nav-items-seeder-controller.txt';
        $nav_items_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/NavItemsSeederController.php';

        // array of files

        $files = [

            $nav_heading_model_template => $nav_heading_file,

            $nav_item_model_template => $nav_item_model_file,

            $nav_headings_controller_template => $nav_headings_controller_file,

            $nav_items_controller_template => $nav_items_controller_file,

            $nav_headings_migration_template => $nav_headings_migration_file,

            $nav_items_migration_template => $nav_items_migration_file,

            $nav_headings_seeds_template =>$nav_headings_seeds_file,

            $nav_items_seeds_template => $nav_items_seeds_file
         
        ];

        return $files;

    }

}