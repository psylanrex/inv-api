<?php

namespace App\CodeGenerator\Projects;

use App\CodeGenerator\Routes\ProjectRoutesService;
use App\CodeGenerator\Models\ProjectUserModelService;
use App\CodeGenerator\Seeds\ProjectUserSeedService;
use App\CodeGenerator\Seeds\ProjectRunSeedsService;
use App\CodeGenerator\Projects\MakeStatusFilesService;
use App\CodeGenerator\Projects\MakeProjectFoldersService;
use App\CodeGenerator\Projects\MakeProjectAuthService;
use App\CodeGenerator\Projects\MakeMiddlewareService;
use App\CodeGenerator\CrudSystem\CrudSystemService;
use App\CodeGenerator\Projects\BaseMailService;
use App\CodeGenerator\Projects\MakeProjectRoleService;
use App\CodeGenerator\SupportSystem\MakeSupportSystemService;
use App\CodeGenerator\Projects\MakeProjectNavigationService;
use App\CodeGenerator\Projects\MakeProjectFaqsService;
use App\CodeGenerator\Projects\MakePageContentsService;
use App\CodeGenerator\Projects\MakeProjectCronService;
use App\CodeGenerator\Views\MakeViewsService;


class ProjectSetupService
{

    public $projectRoutesService;
    public $projectUserModelService;
    public $projectUserSeedService;
    public $projectRunSeedsService;
    public $makeStatusFilesService;
    public $makeprojectFoldersService;
    public $makeProjectAuthService;
    public $makeProjectMiddlewareService;
    public $crudSystemService;
    public $baseMailService;
    public $makeProjectRoleService;
    public $makeSupportSystemService;
    public $makeProjectNavigationService;
    public $makeProjectFaqsService;
    public $makePageContentsService;
    public $makeProjectCronService;
    public $makeViewsService;

    public function __construct()
    {

        $this->projectRoutesService = new ProjectRoutesService;
        $this->projectUserModelService = new ProjectUserModelService;
        $this->projectUserSeedService = new ProjectUserSeedService;
        $this->projectRunSeedsService = new ProjectRunSeedsService;
        $this->makeStatusFilesService = New MakeStatusFilesService;
        $this->makeProjectFoldersService = new MakeProjectFoldersService;
        $this->makeProjectAuthService = new MakeProjectAuthService;
        $this->makeProjectMiddlewareService = new MakeProjectMiddlewareService;
        $this->crudSystemService = new CrudSystemService;
        $this->baseMailService = new BaseMailService;
        $this->makeProjectRoleService = new MakeProjectRoleService;
        $this->makeSupportSystemService = new MakeSupportSystemService;
        $this->makeProjectNavigationService = new MakeProjectNavigationService;
        $this->makeProjectFaqsService = new MakeProjectFaqsService;
        $this->makePageContentsService = new MakePageContentsService;
        $this->makeProjectCronService = new MakeProjectCronService;
        $this->makeViewsService = new MakeViewsService;

    }

    public function initializeProject($request)
    {

        $count = 0;

        // make routes file with starter routes

        $this->projectRoutesService->setUpRouteFile($request);

        // 1

        // $count ++;

        // // revise user model 

        // $this->projectUserModelService->makeUserModelAndMigrationFiles($request);

        // 2

        $count ++;

        // make project folders: Utilities, Services, Auth folders in controllers, Auth folders in services

        $this->makeProjectFoldersService->makeProjectFolders();

        // 3

        // $count ++;
        
        // // make user seeds

        // $this->projectUserSeedService->setUpUserSeedFile($request);

        // 4

        // $count ++;

        // // make Run Seeds Controller

        // $this->projectRunSeedsService->makeRunSeedsController($request);

        // // 5

        // $count ++;
        
        // // make status migration, model, controller,  seeds file
        // // the crud seeds and form config seeds for statuses get created when
        // // when running make-crud-system

        // $this->makeStatusFilesService->makeStatusFiles();

        // 6

        $count ++;

        // make auth controllers & requests
        // Auth Login and registration services
        // profanity filter service

        $this->makeProjectAuthService->makeAuthSystem();

        // // 7

        // $count ++;

        // // make middleware is_admin / register the middleware

        //   $this->makeProjectMiddlewareService->makeMiddleware();

        // 8

        $count ++;

        // make crud system

        $this->crudSystemService->makeCrudSystem();

        // // 9

        // $count ++;

        // // make roles system for the project

        // $this->makeProjectRoleService->makeRoleSystem();

        // 10

        $count ++;

        // make mail folders and files, mail view folders and files

        $this->baseMailService->makeBaseMailFiles();

        // 11

        // $count ++;

        // // make support system for project

        // $this->makeSupportSystemService->makeSupportSystem();

        // 12

        // $count ++;

        // // nav headings and nav items

        // $this->makeProjectNavigationService->makeNavigationSystem();

        // 13

        // $count ++;

        // // faqs

        // $this->makeProjectFaqsService->makeFaqs();

        // 14

        // $count ++;

        // // page contents

        // $this->makePageContentsService->makePageContents();

        // 15

        // $count ++;

        // // cron service

        // $this->makeProjectCronService->makeCronService();

        // $count ++;

        // views service

        $this->makeViewsService->makeViews();

        $count ++;

        return "{$count} services ran. Initial setup complete. We are making progres...";

    }


}