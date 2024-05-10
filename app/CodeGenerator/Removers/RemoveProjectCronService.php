<?php

namespace App\CodeGenerator\Removers;

use Illuminate\Http\Request;
use App\CodeGenerator\Removers\RemoveFileService;
use App\CodeGenerator\Removers\RemoveDirectoryService;
use App\CodeGenerator\Removers\RemoveFormConfigSeedService;
use App\CodeGenerator\Removers\RemoveCrudSeedService;
use App\CodeGenerator\Removers\RemoveModelFromRunSeedsService;


class RemoveProjectCronService
{

    public $removeDirectoryService;
    public $removeFileService;
    public $removeFormConfigSeedService;
    public $removeCrudSeedService;
    public $removeModelFromRunSeedsService;

    public function __construct()
    {

        $this->removeDirectoryService = new RemoveDirectoryService;
        $this->removeFileService = new RemoveFileService;
        $this->removeFormConfigSeedService = new RemoveFormConfigSeedService;
        $this->removeCrudSeedService = new RemoveCrudSeedService;
        $this->removeModelFromRunSeedsService = new RemoveModelFromRunSeedsService;

    }

    public function removeProjectCronService()
    {

        $this->removeFolders();

        $this->removeFiles();

        $this->removeFormConfig();

        $this->removeCrudSeed();

        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('Intervals');
        $this->removeModelFromRunSeedsService->removeModelFromRunSeedsController('NavigationStatuses');

        return 'Project Cron Service Gone...';

    }

    



    public function removeFormConfig()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/FormConfigsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeFormConfigSeedService->removeFormConfigSeed('Interval');
            $this->removeFormConfigSeedService->removeFormConfigSeed('NotificationStatus');

        }      

    }

    public function removeCrudSeed()
    {

        $file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/CrudsSeederController.php';

        // check to see if file exists, it might already be gone from another remove process

        if ( file_exists($file) ) {

            $this->removeCrudSeedService->removeCrudSeed('Interval');
            $this->removeCrudSeedService->removeCrudSeed('NotificationStatus');

        }      

    }   

    public function removeFolders()
    {

        $folders = $this->setFolderPaths();

        foreach ($folders as $folder) {

            // check to see if folder exists, it might already be gone from another remove process

            if ( ! is_dir($folder) ) {

                continue;

            }

            $this->removeDirectoryService->removeDirectory($folder);    

        }

    }

    public function removeFiles()
    {

        $files = $this->setFilePaths();

        foreach ($files as $file) {

            // check to see if file exists, it might already be gone from another remove process

            if ( ! file_exists($file) ) {

                continue;

            }

            $this->removeFileService->removeFile($file);

        }

    }

    public function setFilePaths()
    {

        // models

        $cron_log_model_file = base_path() . '/app/Models/CronLog.php';

        $notification_status_model_file = base_path() . '/app/Models/NotificationStatus.php';

        $interval_model_file = base_path() . '/app/Models/Interval.php';      

        // controllers

        $cron_logs_controller_file = base_path() . '/app/Http/Controllers/Admin/CronLogs/CronLogsController.php';

        $intervals_controller_file = base_path() . '/app/Http/Controllers/Admin/Intervals/IntervalsController.php';

        $notification_statuses_controller_file = base_path() . '/app/Http/Controllers/Admin/NotificationStatuses/NotificationStatusesController.php';

        // seeds

        $interval_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/IntervalsSeederController.php';

        $notification_status_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/NotificationStatusesSeederController.php';

        // mail class

        $cron_failure_notification_mail_file = base_path() . '/app/Mail/CronFailureNotification.php';

        // email veiws

        $cron_failure_notification_email_file = base_path() . '/resources/views/email/crons/cron-failure-notification-email.blade.php';

        // command

        $trim_cron_logs_file = base_path() . '/app/Console/Commands/TrimCronLogs.php';

        // handler

        $trim_cron_logs_handler_file = base_path() . '/app/Services/Crons/Handlers/TrimCronLogsHandler.php';
        

        // migrations

        $notification_statuses_migration_file = base_path() . '/database/migrations/2023_12_10_190820_create_notification_statuses_table.php';

        $intervals_migration_file = base_path() . '/database/migrations/2023_12_07_222558_create_intervals_table.php';

        $cron_logs_migration_file = base_path() . '/database/migrations/2023_12_07_221116_create_cron_logs_table.php';


        

        $files = [

            $cron_log_model_file,

            $notification_status_model_file,

            $interval_model_file,

            $cron_logs_controller_file,

            $intervals_controller_file,

            $notification_statuses_controller_file, 

            $interval_seeds_file,

            $notification_status_file,

            $cron_failure_notification_mail_file,

            $cron_failure_notification_email_file,

            $trim_cron_logs_file,

            $trim_cron_logs_handler_file,

            $notification_statuses_migration_file,
            
            $intervals_migration_file,

            $cron_logs_migration_file

            

            

        ];

        return $files;

    }

    public function setFolderPaths()
    {

        $notification_statuses_controller_folder = base_path() . '/app/Http/Controllers/Admin/NotificationStatuses';
        $cron_logs_controller_folder = base_path() . '/app/Http/Controllers/Admin/CronLogs';
        $intervals_controller_folder = base_path() . '/app/Http/Controllers/Admin/Intervals';
        $cron_service_folder = base_path() . '/app/Services/Crons';
        $cron_service_handlers_folder = base_path() . '/app/Services/Crons/Handlers';
        $cron_service_notifications_folder = base_path() . '/app/Services/Crons/Notifications';
        $cron_email_folder = base_path() . '/resources/views/emails/crons';

        


        $folders = [

            $notification_statuses_controller_folder, 
            $cron_logs_controller_folder, 
            $intervals_controller_folder,
            $cron_service_folder,
            $cron_service_handlers_folder,
            $cron_service_notifications_folder,
            $cron_email_folder


        ];

        return $folders;

    }

}