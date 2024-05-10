<?php

namespace App\CodeGenerator\SupportSystem;

use Illuminate\Http\Request;
use App\CodeGenerator\Writers\Writer;
use App\CodeGenerator\Writers\FindOrMakeDirectoryService;
use App\CodeGenerator\Seeds\FoundationSeedService;

class MakeSupportSystemService
{

    public $writer;
    public $findOrMakeDirectoryService;
    public $foundationSeedService;


    public function __construct()
    {

        $this->writer = new Writer;
        $this->findOrMakeDirectoryService = new FindOrMakeDirectoryService;
        $this->foundationSeedService = new FoundationSeedService;

    }

    public function makeSupportSystem()
    {

        // setup array of desintation files and templates

        $files = $this->setDestinationFilesAndTemplates();

        // make folders

        $this->makeFolders();

        // add Support Topic to crud seeds and form config seeds

        $this->makeSeedFiles(); 

        // write the files

        $this->writeFiles($files);


        return 'And now we have support...';

    }

    public function makeSeedFiles()
    {

        // the token system in Foundation Seed service requires a request.

        $request = new Request;

        // add values to request

        $request->merge([

            'model' => 'SupportTopic',
            'controller_type' => 'Admin',
            'controller_folder' => 'SupportTopics',
            'column_1_name' => 'support_topic_name',
            'column_1_type' => 'string-unique',

        ]);

        // foundation seed service will make the seeds for us

        $this->foundationSeedService->makeSeeds($request);

    }


    public function writeFiles($files)
    {

        // write each file, template to file

        foreach ($files as $template_file => $file_path) {

            $this->writer->writeFromTemplate($template_file, $file_path);

        }

    }

    public function makeFolders()
    {

        // set up folder paths

        $folders = $this->setFolders();

        // make folders

        foreach ($folders as $folder) {

            $this->findOrMakeDirectoryService->findOrMakeDirectory($folder);

        }

    }

    public function setFolders()
    {

        // set the paths for the folders we need

        // controllers

        $admin_support_controller_folder = base_path() . '/app/Http/Controllers/Admin/Support';

        $user_support_controller_folder = base_path() . '/app/Http/Controllers/User/Support';

        $support_topics = base_path() . '/app/Http/Controllers/Admin/SupportTopics';

        // services

        $services_support_folder = base_path() . '/app/Services/Support';

        $services_user_support_folder = base_path() . '/app/Services/Support/UserSupport';

        $services_support_form_config = base_path() . '/app/Services/Support/FormConfigs';

        $services_user_support_form_config = base_path() . '/app/Services/Support/UserSupport/FormConfigs';


        // queries  

        $queries_support_folder = base_path() . '/app/Queries/Support';

        $queries_user_support_folder = base_path() . '/app/Queries/Support/UserSupport';


        $folders = [

            $admin_support_controller_folder,
            $user_support_controller_folder,
            $support_topics,
            $services_support_folder,
            $services_user_support_folder,
            $services_support_form_config,
            $services_user_support_form_config,
            $queries_support_folder,
            $queries_user_support_folder
 
        ];

        return $folders;

    }

    public function setDestinationFilesAndTemplates()
    {

        // set the template and file paths that we need

        // controllers

        $support_controller_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Controllers/support-controller.txt';
        $support_controller_file = base_path() . '/app/Http/Controllers/Admin/Support/SupportController.php';
        
        $user_support_controller_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Controllers/user-support-controller.txt';
        $user_support_controller_file = base_path() . '/app/Http/Controllers/User/Support/UserSupportController.php';

        $support_topics_controller_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Controllers/support-topics-controller.txt';
        $support_topics_controller_file = base_path() . '/app/Http/Controllers/Admin/SupportTopics/SupportTopicsController.php';

         // models

         $support_ticket_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Models/support-ticket-model.txt';
         $support_ticket_file = base_path() . '/app/Models/SupportTicket.php';

         $support_topic_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Models/support-topic-model.txt';
         $support_topic_file = base_path() . '/app/Models/SupportTopic.php';


         $ticket_response_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Models/ticket-response-model.txt';
         $ticket_response_file = base_path() . '/app/Models/TicketResponse.php';
 
         // seeds
 
         $support_topic_seeds_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Seeds/support-topic-seeds.txt';
         $support_topic_seeds_file = base_path() . '/app/Http/Controllers/Admin/Dev/Seeders/SupportTopicsSeederController.php';
 
         // migrations
 
         $create_support_topics_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Migrations/support-topics-table.txt';
         $create_support_topics_file = base_path() . '/database/migrations/2023_11_28_220443_create_support_topics_table.php';

         $create_support_tickets_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Migrations/support-tickets-table.txt';
         $create_support_tickets_file = base_path() . '/database/migrations/2023_11_28_223324_create_support_tickets_table.php';


         $create_ticket_responses_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Migrations/ticket-responses-table.txt';
         $create_ticket_responses_file = base_path() . '/database/migrations/2023_11_28_223606_create_ticket_responses_table.php';


        // services - top level folder Support

        $close_ticket_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/close-ticket-service.txt';
        $close_ticket_service_file = base_path() . '/app/Services/Support/CloseTicketService.php';

        $support_reply_to_ticket_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/support-reply-to-ticket-service.txt';
        $support_reply_to_ticket_service_file = base_path() . '/app/Services/Support/SupportReplyToTicketService.php';

        $support_table_data_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/support-table-data-service.txt';
        $support_table_data_service_file = base_path() . '/app/Services/Support/SupportTableDataService.php';


        // services - form configs in Support->FormConfigs

        $support_reply_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/FormConfigs/support-reply-service.txt';
        $support_reply_service_file = base_path() . '/app/Services/Support/FormConfigs/SupportReplyService.php';

        $support_ticket_by_status_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/FormConfigs/support-ticket-by-status-service.txt';
        $support_ticket_by_status_service_file = base_path() . '/app/Services/Support/FormConfigs/SupportTicketByStatusService.php';

        // user Support -> /Services/Support/UserServices

        $mark_as_read_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/UserSupport/mark-as-read-service.txt';
        $mark_as_read_service_file = base_path() . '/app/Services/Support/UserSupport/MarkAsReadService.php';

        $respond_to_support_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/UserSupport/respond-to-support-service.txt';
        $respond_to_support_service_file = base_path() . '/app/Services/Support/UserSupport/RespondToSupportService.php';

        $store_ticket_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/UserSupport/store-ticket-service.txt';
        $store_ticket_service_file = base_path() . '/app/Services/Support/UserSupport/StoreTicketService.php';

        $user_support_table_data_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/UserSupport/user-support-table-data-service.txt';
        $user_support_table_data_service_file = base_path() . '/app/Services/Support/UserSupport/UserSupportTableDataService.php';


        // user Support -> /Services/Support/UserServices/FormConfigs

        $new_response_form_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/UserSupport/FormConfigs/new-response-form-service.txt';
        $new_response_form_service_file = base_path() . '/app/Services/Support/UserSupport/FormConfigs/NewResponseFormService.php';

        $new_ticket_form_config_service_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Services/UserSupport/FormConfigs/new-ticket-form-config-service.txt';
        $new_ticket_form_config_service_file = base_path() . '/app/Services/Support/UserSupport/FormConfigs/NewTicketFormConfigService.php';

        // queries Support Folder

        $show_ticket_to_admin_query_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Queries/show-ticket-to-admin-query.txt';
        $show_ticket_to_admin_query_file = base_path() . '/app/Queries/Support/ShowTicketToAdminQuery.php';


        // queries User Support Folder

        $show_response_to_user_query_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Queries/UserSupport/show-response-to-user-query.txt';
        $show_response_to_user_query_file = base_path() . '/app/Queries/Support/UserSupport/ShowResponseToUserQuery.php';

        $show_ticket_to_user_query_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Queries/UserSupport/show-ticket-to-user-query.txt';
        $show_ticket_to_user_query_file = base_path() . '/app/Queries/Support/UserSupport/ShowTicketToUserQuery.php';

        // rules

        $ticket_belongs_to_user_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Rules/ticket-belongs-to-user.txt';
        $ticket_belongs_to_user_file = base_path() . '/app/Rules/TicketBelongsToUser.php';

        $ticket_is_open_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Rules/ticket-is-open.txt';
        $ticket_is_open_file = base_path() . '/app/Rules/TicketIsOpen.php';

        $ticket_response_belongs_to_user_template = base_path() . '/app/CodeGenerator/Templates/SupportSystem/Rules/ticket-response-belongs-to-user.txt';
        $ticket_response_belongs_to_user_file = base_path() . '/app/Rules/TicketResponseBelongsToUser.php';
       

        $files = [

            $support_controller_template => $support_controller_file,

            $user_support_controller_template => $user_support_controller_file,

            $support_topics_controller_template => $support_topics_controller_file,

            $support_ticket_template => $support_ticket_file,

            $support_topic_template => $support_topic_file,

            $ticket_response_template => $ticket_response_file,
 
            $support_topic_seeds_template => $support_topic_seeds_file,

            $create_support_topics_template => $create_support_topics_file,

            $create_support_tickets_template => $create_support_tickets_file,

            $create_ticket_responses_template => $create_ticket_responses_file,

            $close_ticket_service_template => $close_ticket_service_file,

            $support_reply_to_ticket_service_template => $support_reply_to_ticket_service_file,

            $support_table_data_service_template => $support_table_data_service_file,

            $support_reply_service_template => $support_reply_service_file,

            $support_ticket_by_status_service_template => $support_ticket_by_status_service_file,

            $mark_as_read_service_template => $mark_as_read_service_file,

            $respond_to_support_service_template => $respond_to_support_service_file,

            $store_ticket_service_template => $store_ticket_service_file,

            $user_support_table_data_service_template => $user_support_table_data_service_file,

            $new_response_form_service_template => $new_response_form_service_file, 

            $new_ticket_form_config_service_template => $new_ticket_form_config_service_file, 

            $show_ticket_to_admin_query_template => $show_ticket_to_admin_query_file, 

            $show_response_to_user_query_template => $show_response_to_user_query_file, 

            $show_ticket_to_user_query_template => $show_ticket_to_user_query_file,
            
            $ticket_belongs_to_user_template => $ticket_belongs_to_user_file,

            $ticket_is_open_template => $ticket_is_open_file,

            $ticket_response_belongs_to_user_template => $ticket_response_belongs_to_user_file

        ];

        return $files;

    }

}