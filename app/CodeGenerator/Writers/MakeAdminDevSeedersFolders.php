<?php

namespace App\CodeGenerator\Writers;

use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class MakeAdminDevSeedersFolders
{

    public static function makeFolders()
    {

        // directory paths

        $admin_folder = base_path() . '/app/Http/Controllers/Admin';

        $dev_folder = base_path() . '/app/Http/Controllers/Admin/Dev';

        $seeders_folder = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders';

        // make directory will make directory if needed

        $service = new FindOrMakeDirectoryService;

        $service->findOrMakeDirectory($admin_folder);
        $service->findOrMakeDirectory($dev_folder);
        $service->findOrMakeDirectory($seeders_folder);


    }



}

