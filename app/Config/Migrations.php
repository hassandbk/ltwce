<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Migrations extends BaseConfig
{
    public bool   $enabled         = true;          // always on
    public string $table           = 'migrations';  // track applied files
    public string $timestampFormat = 'YmdHis_';     // filename prefix format
}
