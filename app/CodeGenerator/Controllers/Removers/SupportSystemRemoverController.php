<?php

namespace App\CodeGenerator\Controllers\Removers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveSupportSystemService;


class SupportSystemRemoverController extends Controller
{
    public function removeSupportSystem(RemoveSupportSystemService $service)
    {

        return $service->removeSupportSystem();


    }
}
