<?php

namespace Config;

use CodeIgniter\Config\AutoloadConfig;

class Autoload extends AutoloadConfig
{
    public $psr4 = [
        APP_NAMESPACE    => APPPATH,          // covers Controllers, Models, Services, etc.
        'App\Libraries'  => APPPATH . 'Libraries',
        'App\Commands'   => APPPATH . 'Commands',
        'App\Entities'   => APPPATH . 'Entities',
        'App\ThirdParty' => APPPATH . 'ThirdParty',
        // If you created Services in app/Services, you could add:
        //'App\Services'   => APPPATH . 'Services',
    ];

    public $classmap = [];

    public $files = [
        APPPATH . 'Config/Constants.php',
        // e.g. APPPATH . 'Config/SomeOtherGlobals.php',
    ];

    public $helpers = [
        'url', 'form', 'date',
        'text', 'number',
        'filesystem', 'security',
        'money_helper', 'auth_helper',
        'notification_helper', 'file_helper',
    ];
}
