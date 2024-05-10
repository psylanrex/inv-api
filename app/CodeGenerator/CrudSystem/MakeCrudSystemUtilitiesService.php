<?php

namespace App\CodeGenerator\CrudSystem;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class MakeCrudSystemUtilitiesService
{

    public $writer;
    public $findOrMakeDirectoryService;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;


    }

    public function makeUtilities()
    {

        // set the paths we need

        $files = $this->setPaths();

        // make sure we have the folder we need

        $this->makeDirectories();

        // write the files

        $this->writeFiles($files);


        return 'make the utilities';

    }

    public function writeFiles($files)
    {

        // feed in the template path and destination path into the writer

        foreach ( $files as $template => $file ) {

            $this->writer->writeFromTemplate($template, $file);

        } 

    }

    public function setPaths()
    {

        $drop_down_list_maker_template = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Utilities/drop-down-list-maker.txt';

        $drop_down_list_maker_path = base_path() . '/app/Utilities/DropDownListMaker.php';


        $sort_by_template = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Utilities/sort-by.txt';

        $sort_by_path = base_path() . '/app/Utilities/SortBy.php';

        $include_routes_template = base_path() . '/app/CodeGenerator/Templates/CrudSystem/Utilities/include-routes.txt';

        $include_routes_path = base_path() . '/app/Utilities/IncludeRoutes.php';


        $files = [

            $drop_down_list_maker_template => $drop_down_list_maker_path,
            $sort_by_template => $sort_by_path,
            $include_routes_template => $include_routes_path

        ];  
        
        return $files;

    }

    public function makeDirectories()
    {

        $utilities_folder = base_path() . '/app/Utilities';

        
        // we use array format in case we need more folders

        $folders = [$utilities_folder];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }


}