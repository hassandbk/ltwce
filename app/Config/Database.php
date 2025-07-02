<?php

namespace Config;

use CodeIgniter\Database\Config;

class Database extends Config
{
    /**
     * 1. Migrations & Seeds location
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * 2. Default connection group
     *
     *    We’ll switch to ‘tests’ automatically when running PHPUnit.
     */
    public string $defaultGroup = 'default';

    /**
     * 3. Default DB connection
     *
     *    – Use env() so credentials stay out of version control.
     *    – Turn off DBDebug in production.
     *    – Enable strict mode to catch bad SQL.
     *    – Use utf8mb4 for full unicode support.
     */
    public array $default;

    /**
     * 4. Testing DB connection
     *
     *    Uses an in-memory SQLite DB so your tests never touch real data.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',   // CI convention so you can test prefixes too
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => '',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,    // enforce FK checks in tests
        'busyTimeout' => 1000,
        'dateFormat'  => [
            'date'     => 'Y-m-d',
            'datetime' => 'Y-m-d H:i:s',
            'time'     => 'H:i:s',
        ],
    ];

    public function __construct()
    {
        parent::__construct();

        // 5. Automatically switch to tests when you run phpunit
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }

        $this->default = [
            'DSN'          => '',
            'hostname'     => env('DB_HOST', '127.0.0.1'),
            'username'     => env('DB_USER', 'ci_user'),
            'password'     => env('DB_PASS', 'ci_pass'),
            'database'     => env('DB_NAME', 'microfinance'),
            'DBDriver'     => 'MySQLi',
            'DBPrefix'     => '',
            'pConnect'     => false,
            'DBDebug'      => (ENVIRONMENT !== 'production'),
            'charset'      => 'utf8mb4',
            'DBCollat'     => 'utf8mb4_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => true,
            'failover'     => [],
            'port'         => 3306,
            'numberNative' => false,
            'foundRows'    => false,
            'dateFormat'   => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];
    }
}
