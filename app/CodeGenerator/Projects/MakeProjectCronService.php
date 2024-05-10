<?php

namespace App\CodeGenerator\Projects;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Writers\ConsoleKernelWriter;
use App\CodeGenerator\Seeds\FoundationSeedService;

class MakeProjectCronService
{

    public $writer;
    public $findOrMakeDirectoryService;
    public $foundationSeedService;
    public $consoleKernelWriter;


    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;
        $this->foundationSeedService = new FoundationSeedService;
        $this->consoleKernelWriter = new ConsoleKernelWriter;

    }

    public function makeCronService()
    {

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // make folders

        $this->makeFolders();

        // make crud and form config seeds

        $this->makeSeedFiles(); 

        // write the files

        $this->writeFiles($files);

        // Add line to Kernel for schedule of command

        $this->addLineToKernel();

    }

    public function addLineToKernel()
    {

        $line = '// $schedule->command(\'app:trim-cron-logs\')->everyMinute()->onOneServer();';

        $this->consoleKernelWriter->addLineToKernel($line);     

    }

    public function makeSeedFiles()
    {

        // we use FoundationSeedService to create crud seeds and form config seeds
        // we will be overwriting the model seeds file made from this service

        // the token system in Foundation Seed service requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'Interval',
            'controller_type' => 'Admin',
            'controller_folder' => 'Intervals',
            'column_1_name' => 'interval_name',
            'column_1_type' => 'string-unique'

        ]);

        // foundation seed service will make the crud and form config seeds for us

        $this->foundationSeedService->makeSeeds($request);

        $request2 = new Request;

        // add values to request

        $request2->merge([

            'model' => 'NotificationStatus',
            'controller_type' => 'Admin',
            'controller_folder' => 'NotificationStatuses',
            'column_1_name' => 'notification_status_name',
            'column_1_type' => 'string-unique'

        ]);

        // foundation seed service will make the crud and form config seeds for us

        $this->foundationSeedService->makeSeeds($request2);

        

    }

    public function writeFiles($files)
    {

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function makeFolders()
    {

        // make folders

        $commands_folder = base_path() . '/app/Console/Commands';
        $notification_statuses_controller_folder = base_path() . '/app/Http/Controllers/Admin/NotificationStatuses';
        $cron_logs_controller_folder = base_path() . '/app/Http/Controllers/Admin/CronLogs';
        $intervals_controller_folder = base_path() . '/app/Http/Controllers/Admin/Intervals';
        $cron_service_folder = base_path() . '/app/Services/Crons';
        $cron_service_notifications_folder = base_path() . '/app/Services/Crons/Notifications';
        $cron_email_folder = base_path() . '/resources/views/emails/crons';
        $cron_service_handlers_folder = base_path() . '/app/Services/Crons/Handlers';


        

        $folders = [
            
            $commands_folder,
            $notification_statuses_controller_folder, 
            $cron_logs_controller_folder, 
            $intervals_controller_folder,
            $cron_service_folder, 
            $cron_service_notifications_folder,
            $cron_email_folder,
            $cron_service_handlers_folder
                    
        ];

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }



    }

    public function setDestinationFilesAndTemplates()
    {

        // models

        $cron_log_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/cron-log-model.txt';
        $cron_log_model_file = base_path() . '/app/Models/CronLog.php';

        $notification_status_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/notification-status-model.txt';
        $notification_status_model_file = base_path() . '/app/Models/NotificationStatus.php';

        $interval_model_template = base_path() . '/app/CodeGenerator/Templates/Projects/Models/interval-model.txt';
        $interval_model_file = base_path() . '/app/Models/Interval.php';      

        // controllers

        $cron_logs_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/cron-logs-controller.txt';
        $cron_logs_controller_file = base_path() . '/app/Http/Controllers/Admin/CronLogs/CronLogsController.php';

        $intervals_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/intervals-controller.txt';
        $intervals_controller_file = base_path() . '/app/Http/Controllers/Admin/Intervals/IntervalsController.php';

        $notification_statuses_controller_template = base_path() . '/app/CodeGenerator/Templates/Projects/Controllers/notification-statuses-controller.txt';
        $notification_statuses_controller_file = base_path() . '/app/Http/Controllers/Admin/NotificationStatuses/NotificationStatusesController.php';

        // seeds

        $interval_seeds_template = base_path() . '/app/CodeGenerator/Templates/Projects/Seeds/interval-seeds.txt';
        $interval_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/IntervalsSeederController.php';

        $notification_status_seeds_template = base_path() . '/app/CodeGenerator/Templates/Projects/Seeds/notification-status-seeds.txt';
        $notification_status_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/NotificationStatusesSeederController.php';

        // mail class

        $cron_failure_notification_mail_template = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/cron-failure-notification-email.txt';
        $cron_failure_notification_mail_file = base_path() . '/app/Mail/CronFailureNotification.php';

        // email veiws

        $cron_failure_notification_email_template = base_path() . '/app/CodeGenerator/Templates/Projects/Mail/cron-failure-notification-email-blade.txt';
        $cron_failure_notification_email_file = base_path() . '/resources/views/emails/crons/cron-failure-notification-email.blade.php';


        // services

        $cron_service_template = base_path() . '/app/CodeGenerator/Templates/Projects/Services/cron-service.txt';
        $cron_service_file = base_path() . '/app/Services/Crons/CronService.php';

        $cron_fail_notification_service_template = base_path() . '/app/CodeGenerator/Templates/Projects/Services/cron-fail-notification-service.txt';
        $cron_fail_notification_service_file = base_path() . '/app/Services/Crons/Notifications/CronFailNotificationService.php';

        // command

        $trim_cron_logs_template = base_path() . '/app/CodeGenerator/Templates/Projects/Commands/trim-cron-logs.txt';
        $trim_cron_logs_file = base_path() . '/app/Console/Commands/TrimCronLogs.php';

        // handler

        $trim_cron_logs_handler_template = base_path() . '/app/CodeGenerator/Templates/Projects/Handlers/trim-cron-logs-handler.txt';

        $trim_cron_logs_handler_file = base_path() . '/app/Services/Crons/Handlers/TrimCronLogsHandler.php';
        

        // migrations

        $notification_statuses_migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/notification-statuses-migration.txt';
        $notification_statuses_migration_file = base_path() . '/database/migrations/2023_12_10_190820_create_notification_statuses_table.php';

        $intervals_migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/intervals-migration.txt';
        $intervals_migration_file = base_path() . '/database/migrations/2023_12_07_222558_create_intervals_table.php';

        $cron_logs_migration_template = base_path() . '/app/CodeGenerator/Templates/Projects/Migrations/cron-logs-migration.txt';
        $cron_logs_migration_file = base_path() . '/database/migrations/2023_12_07_221116_create_cron_logs_table.php';

        

        $files = [

            $cron_log_model_template => $cron_log_model_file,

            $notification_status_model_template => $notification_status_model_file,

            $interval_model_template => $interval_model_file,

            $cron_logs_controller_template => $cron_logs_controller_file,

            $intervals_controller_template => $intervals_controller_file,

            $notification_statuses_controller_template => $notification_statuses_controller_file, 

            $interval_seeds_template => $interval_seeds_file,

            $notification_status_seeds_template =>$notification_status_file,

            $cron_failure_notification_mail_template => $cron_failure_notification_mail_file,

            $cron_failure_notification_email_template => $cron_failure_notification_email_file,

            $cron_service_template => $cron_service_file,

            $cron_fail_notification_service_template => $cron_fail_notification_service_file,

            $notification_statuses_migration_template => $notification_statuses_migration_file,
            
            $intervals_migration_template => $intervals_migration_file,

            $cron_logs_migration_template => $cron_logs_migration_file,

            $trim_cron_logs_template => $trim_cron_logs_file,

            $trim_cron_logs_handler_template => $trim_cron_logs_handler_file

        ];

        return $files;

    }

   


}