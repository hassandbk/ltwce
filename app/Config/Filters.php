<?php

namespace Config;

use CodeIgniter\Config\Filters as BaseFilters;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\ForceHTTPS;
use CodeIgniter\Filters\PageCache;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\PerformanceMetrics;  // ← Added import
use App\Filters\AuthFilter;
use App\Filters\AuditLogFilter;

class Filters extends BaseFilters
{
    /**
     * Aliases for filter classes to make referencing easier.
     */
    public array $aliases = [
        'csrf'         => CSRF::class,
        'forcehttps'   => ForceHTTPS::class,     
        'toolbar'      => DebugToolbar::class,
        'pagecache'    => PageCache::class,

        // ← Register the built-in performance-metrics filter
        'performance'  => PerformanceMetrics::class,

        'auth'         => AuthFilter::class,
        'audit'        => AuditLogFilter::class,
    ];

    /**
     * Filters that run globally before and after every request.
     */
    public array $globals = [
        'before' => [
            'forcehttps',          // Redirect HTTP → HTTPS
            'csrf',                // CSRF protection on POST/PUT/DELETE
            'auth' => ['except' => ['auth/*', '/', 'home/*']], // Auth filter except certain routes
        ],
        'after'  => [
            'toolbar',             // Developer toolbar
            'audit',               // Audit log for every request
            // Note: performance metrics are automatically applied via BaseFilters::$required
        ],
    ];

    /**
     * Method-specific filters, keyed by HTTP method (GET, POST, etc).
     */
    public array $methods = [];

    /**
     * Route-specific filters, keyed by filter alias with array of routes.
     */
    public array $filters = [];
}
