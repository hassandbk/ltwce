<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class App extends BaseConfig
{
    public string $baseURL;
    public array $allowedHostnames = [];

    public string $indexPage;
    public string $uriProtocol = 'REQUEST_URI';
    public string $permittedURIChars = 'a-z 0-9~%.:_\-';

    public string $defaultLocale = 'en';
    public bool $negotiateLocale = false;
    public array $supportedLocales = ['en'];

    public string $appTimezone;

    public string $charset = 'UTF-8';
    public bool $forceGlobalSecureRequests;

    public array $proxyIPs = [];

    public bool $CSPEnabled;

    public function __construct()
    {
        parent::__construct();

        // Initialize dynamic values from .env
        $this->baseURL = env('APP_BASEURL', 'http://localhost:8080/');
        $this->indexPage = env('APP_INDEXPAGE', '');
        $this->appTimezone = env('APP_TIMEZONE', 'Africa/Kampala');

        $this->forceGlobalSecureRequests = filter_var(
            env('APP_FORCE_GLOBAL_SECURE_REQUESTS', (ENVIRONMENT === 'production') ? 'true' : 'false'),
            FILTER_VALIDATE_BOOLEAN
        );

        $this->CSPEnabled = filter_var(
            env('APP_CSP_ENABLED', 'false'),
            FILTER_VALIDATE_BOOLEAN
        );
    }
}
