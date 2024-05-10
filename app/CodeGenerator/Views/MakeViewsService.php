<?php

namespace App\CodeGenerator\Views;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;

class MakeViewsService
{

    public $writer;
    public $findOrMakeDirectoryService;

    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;

    }

    public function makeViews()
    {

        // set folder paths

        $folders = $this->setFolders();

        // make folders

        $this->makeFolders($folders);

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // write the files

        $this->writeFiles($files);

        return ['message' => 'View folders, view files, and web.php have been created.'];

    }

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function setFolders()
    {

        $views_folder = base_path() . '/resources/views';
        $code_generators_folder = base_path() . '/resources/views/code-generators';
        $forms_folder = base_path() . '/resources/views/code-generators/forms';
        $headers_folder = base_path() . '/resources/views/code-generators/headers';

        $folders = [
            
            $views_folder,
            $code_generators_folder,
            $forms_folder,
            $headers_folder 
        
        ];

        return $folders;

    }

    public function makeFolders($folders)
    {

        // make view folders

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }

    public function setDestinationFilesAndTemplates()
    {

        // index

        $index_template = base_path() . '/app/CodeGenerator/Templates/Views/index.txt';
        $index_file = base_path() . '/resources/views/code-generators/index.blade.php';

        // generators

        $add_env_template = base_path() . '/app/CodeGenerator/Templates/Views/Generators/add-env.txt';
        $add_env_file = base_path() . '/resources/views/code-generators/add-env.blade.php';

        $make_new_foundation_template = base_path() . '/app/CodeGenerator/Templates/Views/Generators/make-new-foundation.txt';
        $make_new_foundation_file = base_path() . '/resources/views/code-generators/make-new-foundation.blade.php';

        $make_new_service_template = base_path() . '/app/CodeGenerator/Templates/Views/Generators/make-new-service.txt';
        $make_new_service_file = base_path() . '/resources/views/code-generators/make-new-service.blade.php';

        $make_project_template = base_path() . '/app/CodeGenerator/Templates/Views/Generators/make-project.txt';
        $make_project_file = base_path() . '/resources/views/code-generators/make-project.blade.php';

        $make_new_cron_template = base_path() . '/app/CodeGenerator/Templates/Views/Generators/make-new-cron.txt';
        $make_new_cron_file = base_path() . '/resources/views/code-generators/make-new-cron.blade.php';

        // removers

        $remove_project_template = base_path() . '/app/CodeGenerator/Templates/Views/Removers/remove-project.txt';
        $remove_project_file = base_path() . '/resources/views/code-generators/remove-project.blade.php';

        $remove_service_template = base_path() . '/app/CodeGenerator/Templates/Views/Removers/remove-service.txt';
        $remove_service_file = base_path() . '/resources/views/code-generators/remove-service.blade.php';

        $remove_foundation_template = base_path() . '/app/CodeGenerator/Templates/Views/Removers/remove-foundation.txt';
        $remove_foundation_file = base_path() . '/resources/views/code-generators/remove-foundation.blade.php';

        $remove_env_template = base_path() . '/app/CodeGenerator/Templates/Views/Removers/remove-env.txt';
        $remove_env_file = base_path() . '/resources/views/code-generators/remove-env.blade.php';

        $remove_cron_template = base_path() . '/app/CodeGenerator/Templates/Views/Removers/remove-cron.txt';
        $remove_cron_file = base_path() . '/resources/views/code-generators/remove-cron.blade.php';
 

        // headers

        $head_template = base_path() . '/app/CodeGenerator/Templates/Views/Headers/head.txt';
        $head_file = base_path() . '/resources/views/code-generators/Headers/head.blade.php';

        $links_template = base_path() . '/app/CodeGenerator/Templates/Views/Headers/links.txt';
        $links_file = base_path() . '/resources/views/code-generators/Headers/links.blade.php';

        $style_template = base_path() . '/app/CodeGenerator/Templates/Views/Headers/style.txt';
        $style_file = base_path() . '/resources/views/code-generators/Headers/style.blade.php';

        $errors_template = base_path() . '/app/CodeGenerator/Templates/Views/Headers/errors.txt';
        $errors_file = base_path() . '/resources/views/code-generators/Headers/errors.blade.php';

        // forms

        $add_env_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/add-env-form.txt';
        $add_env_form_file = base_path() . '/resources/views/code-generators/Forms/add-env-form.blade.php';

        $foundation_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/foundation-form.txt';
        $foundation_form_file = base_path() . '/resources/views/code-generators/Forms/foundation-form.blade.php';

        $make_project_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/make-project-form.txt';
        $make_project_form_file = base_path() . '/resources/views/code-generators/Forms/make-project-form.blade.php';

        $new_service_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/new-service-form.txt';
        $new_service_form_file = base_path() . '/resources/views/code-generators/Forms/new-service-form.blade.php';

        $new_cron_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/cron-form.txt';
        $new_cron_form_file = base_path() . '/resources/views/code-generators/Forms/cron-form.blade.php';

        $remove_cron_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/remove-cron-form.txt';
        $remove_cron_form_file = base_path() . '/resources/views/code-generators/Forms/remove-cron-form.blade.php';


        $remove_env_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/remove-env-form.txt';
        $remove_env_form_file = base_path() . '/resources/views/code-generators/Forms/remove-env-form.blade.php';

        $remove_service_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/remove-service-form.txt';
        $remove_service_form_file = base_path() . '/resources/views/code-generators/Forms/remove-service-form.blade.php';

        $remove_foundation_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/remove-foundation-form.txt';
        $remove_foundation_form_file = base_path() . '/resources/views/code-generators/Forms/remove-foundation-form.blade.php';

        $remove_project_form_template = base_path() . '/app/CodeGenerator/Templates/Views/Forms/remove-project-form.txt';
        $remove_project_form_file = base_path() . '/resources/views/code-generators/Forms/remove-project-form.blade.php';


        // routes -- this is not a view file, it creates the routes to the views

        $web_routes_template = base_path() . '/app/CodeGenerator/Templates/Views/Routes/web.txt';
        $web_routes_file = base_path() . '/routes/web.php';

        

        $files = [

            $index_template => $index_file,

            $add_env_template => $add_env_file,

            $make_new_foundation_template => $make_new_foundation_file,

            $make_new_service_template => $make_new_service_file, 

            $make_project_template => $make_project_file, 

            $make_new_cron_template => $make_new_cron_file,

            $remove_project_template => $remove_project_file,
            
            $remove_service_template => $remove_service_file, 

            $remove_foundation_template => $remove_foundation_file, 

            $remove_env_template => $remove_env_file, 

            $remove_cron_template => $remove_cron_file,

            $head_template => $head_file,

            $links_template => $links_file,

            $style_template => $style_file,

            $add_env_form_template =>$add_env_form_file, 
        
            $foundation_form_template => $foundation_form_file, 
            
            $make_project_form_template => $make_project_form_file, 
            
            $new_service_form_template => $new_service_form_file,

            $new_cron_form_template => $new_cron_form_file,

            $remove_cron_form_template => $remove_cron_form_file,
            
            $remove_env_form_template => $remove_env_form_file, 
            
            $remove_service_form_template => $remove_service_form_file, 
            
            $remove_foundation_form_template => $remove_foundation_form_file, 

            $remove_project_form_template => $remove_project_form_file,

            $web_routes_template => $web_routes_file,
            
            $errors_template => $errors_file

        ];

        return $files;

    }

}