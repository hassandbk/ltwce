<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\PerformanceMetrics;
use App\Filters\AuthFilter;
use App\Filters\AuditLogFilter;

class Filters extends BaseFilters
{
    public array $aliases = [
        'csrf' => CSRF::class,
        'forcehttps' => ForceHTTPS::class,
        'toolbar' => DebugToolbar::class,
        'pagecache' => PageCache::class,
        'performance' => PerformanceMetrics::class,
        'auth' => AuthFilter::class,
        'audit' => AuditLogFilter::class,
    ];

    public array $globals = [
        'before' => [
            'forcehttps',
            'csrf',
            // no 'auth' here any more
        ],
        'after' => [
            'toolbar',
            'audit',
        ],
    ];

    public array $methods = [];

    public array $filters = [];
}
