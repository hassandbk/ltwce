<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Cache\Handlers\DummyHandler;
use CodeIgniter\Cache\Handlers\FileHandler;
use CodeIgniter\Cache\Handlers\MemcachedHandler;

class Cache extends BaseConfig
{
    /**
     * --------------------------------------------------------------------------
     * Primary Handler
     * --------------------------------------------------------------------------
     *
     * The preferred handler. 'file' uses the filesystem (no extra software).
     * 'memcached' uses an in-memory daemon (also free & open-source).
     * 'dummy' does no caching (useful for testing).
     */
    public string $handler;

    /**
     * --------------------------------------------------------------------------
     * Backup Handler
     * --------------------------------------------------------------------------
     *
     * Used if the primary handler fails. E.g. fallback to 'dummy' so your
     * app keeps working even if Memcached goes down.
     */
    public string $backupHandler;

    /**
     * --------------------------------------------------------------------------
     * Key Prefix
     * --------------------------------------------------------------------------
     *
     * Prepended to all cache keys to avoid collisions if multiple apps share
     * the same cache store.
     */
    public string $prefix;

    /**
     * --------------------------------------------------------------------------
     * Default TTL
     * --------------------------------------------------------------------------
     *
     * Time-to-live (in seconds) when none is specified. 3600 = 1 hour.
     */
    public int $ttl;

    /**
     * --------------------------------------------------------------------------
     * File Handler Settings
     * --------------------------------------------------------------------------
     *
     * Only used when $handler === 'file' or $backupHandler === 'file'.
     */
    public array $file = [
        'storePath' => WRITEPATH . 'cache/',  // must be writable
        'mode'      => 0640,                  // file permissions
    ];

    /**
     * --------------------------------------------------------------------------
     * Memcached Handler Settings
     * --------------------------------------------------------------------------
     *
     * Only used when $handler === 'memcached' or $backupHandler === 'memcached'.
     */
    public array $memcached;

    /**
     * --------------------------------------------------------------------------
     * Available Cache Handlers
     * --------------------------------------------------------------------------
     *
     * Lists the alias and class for each driver you want to allow.
     */
    public array $validHandlers = [
        'dummy'     => DummyHandler::class,
        'file'      => FileHandler::class,
        'memcached' => MemcachedHandler::class,
    ];

    /**
     * --------------------------------------------------------------------------
     * Web Page Caching: Cache Include Query String
     * --------------------------------------------------------------------------
     *
     * Whether to take the URL query string into account when generating
     * output cache files.
     *
     *    false = Disabled
     *    true  = All query parameters
     *    ['page', 'sort'] = Only these parameters
     */
    public bool|array $cacheQueryString = false;

    /**
     * Constructor to load dynamic environment values
     */
    public function __construct()
    {
        parent::__construct();

        $this->handler       = env('CACHE_HANDLER', 'file');
        $this->backupHandler = env('CACHE_BACKUP_HANDLER', 'dummy');
        $this->prefix        = env('CACHE_PREFIX', 'mf_');
        $this->ttl           = (int) env('CACHE_TTL', 3600);

        $this->memcached = [
            'host'   => env('MEMCACHED_HOST', '127.0.0.1'),
            'port'   => (int) env('MEMCACHED_PORT', 11211),
            'weight' => 1,
            'raw'    => false,
        ];
    }
}
