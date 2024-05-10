<?php

namespace App\CodeGenerator\CrudSystem;

use App\CodeGenerator\CrudSystem\CrudsBaseService;
use App\CodeGenerator\CrudSystem\FormConfigsBaseService;
use App\CodeGenerator\CrudSystem\AddAndEditServices;
use App\CodeGenerator\CrudSystem\MakeCrudSystemUtilitiesService;


class CrudSystemService
{

    public $CrudsBaseService;
    public $formConfigsBaseService;
    public $addAndEditServices;
    public $makeCrudSystemUtilitiesService;


    public function __construct()
    {

        $this->CrudsBaseService = new CrudsBaseService;
        $this->formConfigsBaseService = new FormConfigsBaseService;
        $this->addAndEditServices = new AddAndEditServices;
        $this->makeCrudSystemUtilitiesService = new MakeCrudSystemUtilitiesService;
       
    }

    public function makeCrudSystem()
    {

        $this->CrudsBaseService->makeCrudsBase();

        

        $this->formConfigsBaseService->makeFormConfigsBase();



        $this->addAndEditServices->makeEditAndAddServices();


        $this->makeCrudSystemUtilitiesService->makeUtilities();



        return ['message' => 'Crud System Created'];

    }

}