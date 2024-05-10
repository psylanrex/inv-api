<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Middleware\AddMiddlewareToKernelService;

class MakeProjectMiddlewareService
{

    public $writer;
    public $addMiddlewareToKernelService;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->addMiddlewareToKernelService = new AddMiddlewareToKernelService;
    }

    public function makeMiddleware()
    {

        $this->makeAllMiddleware(); 

        $this->addToKernel();

    }

    public function addToKernel()
    {

        // new lines to add to protected $middlewareAliases

        $is_admin = "'isAdmin' => \App\Http\Middleware\IsAdmin::class,";
        $roles = "'roles' => \App\Http\Middleware\CheckRole::class,";

        // add as many kernel aliases as we need to the array.

        $kernel_aliases = [$is_admin, $roles];

        // write to Kernel protected $middlewareAliases

        foreach ($kernel_aliases as $alias) {

            $this->addMiddlewareToKernelService->addToKernel($alias);

        }

    }


    public function makeAllMiddleware()
    {

        // set paths

        $is_admin_template = base_path() . '/app/CodeGenerator/Templates/Projects/Middleware/is-admin.txt';
        $is_admin_file = base_path() . '/app/Http/Middleware/IsAdmin.php';

        $check_role_template = base_path() . '/app/CodeGenerator/Templates/Projects/Middleware/check-role.txt';
        $check_role_file = base_path() . '/app/Http/Middleware/CheckRole.php';

        // add as many middlewares as we need to the array.

        $middlewares = [$is_admin_template => $is_admin_file,
                        $check_role_template => $check_role_file];

        // write each middleware from array

        foreach ($middlewares as $template => $file) {

            $this->writer->writeFromTemplate($template, $file);

        }

    }

    



}