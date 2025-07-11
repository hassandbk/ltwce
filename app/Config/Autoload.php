<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    // Autoloading libraries and services
    public $psr4 = [
        APP_NAMESPACE => APPPATH,          // Covers Controllers, Models, Services, etc.
        'App\Libraries' => APPPATH . 'Libraries',  // Custom Libraries
        'App\Commands' => APPPATH . 'Commands',   // Custom CLI Commands
        'App\Entities' => APPPATH . 'Entities',   // Custom Entities (ORM-style)
        'App\ThirdParty' => APPPATH . 'ThirdParty', // Third-party libraries
        'App\Services' => APPPATH . 'Services',
        // Add other namespaces as needed:
    ];

    // Manually specify class maps, for cases where autoloading doesn't work or you want to override
    public $classmap = [
        // Add any non-PSR-4 classes here if necessary
    ];

    // Files to be included (e.g., constants, global configurations)
    public $files = [
        APPPATH . 'Config/Constants.php', // Define global constants
        APPPATH . 'Config/SomeOtherGlobals.php', // Example of another global config
    ];

    // Autoloading helpers
    public $helpers = [
        // Core helpers provided by CodeIgniter
        'url',
        'form',
        'date',
        'text',
        'number',
        'filesystem',
        'security',

        // Custom helpers specific to your app
        'money_helper',        // Custom helper for currency formatting
        'auth_helper',         // Authentication and user management helpers
        'notification_helper', // For handling notifications
        'file_helper',         // File management helpers
        'view_helper',         // For loading views and partials (header, footer, modals)
        'array_helper',        // Helper for working with arrays
        'string_helper',       // For string manipulations
        'email_helper',        // Email-related helper (e.g., sending emails)
        'pagination_helper',   // Pagination functionality helper
    ];
}
