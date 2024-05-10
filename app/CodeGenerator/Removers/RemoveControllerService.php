<?php

namespace App\CodeGenerator\Removers;

use App\CodeGenerator\Formatters\ModelNameFormatter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class RemoveControllerService
{

    public function removeController($request)
    {

        $model_name = $request->get('model');

        $model_name = ModelNameFormatter::formatModelName($model_name);

        $folder_name = Str::plural($model_name);

        $controller_name = $folder_name . 'Controller.php';

        $file = $controller_name;
        
        $admin_path = base_path('app/Http/Controllers/Admin/'. $folder_name);

        $file_path = $admin_path . '/' . $file;

        // check to see if folder and file exist in Admin

        $file_exists = $this->checkForFile($admin_path, $controller_name);


        if ( ! $file_exists ) {

            // check to see if folder and file exist in user

            $user_path = base_path('app/Http/Controllers/User/'. $folder_name);

            $file_path = $user_path . '/' . $file;

            $file_exists = $this->checkForFile($user_path, $controller_name);

            if ( ! $file_exists ) {

                return FALSE;
              

            }

            // remove file

            unlink($file_path);

            // remove directory

            rmdir($user_path);

            return True;

        }

        unlink($file_path);

        rmdir($admin_path);

        return True;


    }

    public function checkForFile($path, $controller_name)
    {

        // check for directory

        if ( ! File::exists($path) ) {

            return FALSE;


        }

        // check for file

        if ( ! File::exists($path . '/' . $controller_name ) ) {

            return FALSE;


        }

        return TRUE;


    }



}