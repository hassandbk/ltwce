<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Log\Handlers\FileHandler;

class Logger extends BaseConfig
{
    // Show debug in dev, info+ in staging, warning+ in prod
    public int|array $threshold = (ENVIRONMENT === 'production')
                                ? ['critical','alert','emergency','error','warning']
                                : (ENVIRONMENT === 'testing' ? 1 : 9);

    public string $dateFormat = 'Y-m-d H:i:s';

    public array $handlers = [
        FileHandler::class => [
            'handles'        => ['critical','error','warning','info','debug'],
            'fileExtension'  => 'log',
            'filePermissions'=> 0644,
            'path'           => WRITEPATH . 'logs/',
        ],
        // Add Sentry, Slack, etc. here as needed
    ];
}
