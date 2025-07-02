<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\Errors::show404');
$routes->setAutoRoute(false);

// Public
$routes->get('/',                     'Home::index');
$routes->get('auth/login',            'AuthController::showLogin');
$routes->post('auth/login',           'AuthController::attemptLogin');
$routes->get('auth/logout',           'AuthController::logout', ['filter' => 'auth']);

// Protected
$routes->group('', ['filter' => 'auth'], function($r) {
    // Users & Roles
    $r->resource('roles',       ['controller' => 'RoleController']);
    $r->resource('users',       ['controller' => 'UserController']);
    $r->resource('permissions',['controller' => 'PermissionController']);

    // Member lifecycle
    $r->resource('members',     ['controller' => 'MemberController']);

    // Groups & Officers
    $r->resource('groups',      ['controller' => 'GroupController']);
    $r->resource('officers',    ['controller' => 'FieldOfficerController']);

    // Loans
    $r->resource('loans',       ['controller' => 'LoanController']);
    $r->post('loans/(:segment)/approve', 'LoanController::approve/$1');
    $r->post('loans/(:segment)/repay',   'LoanController::repay/$1');

    // Savings & Shares
    $r->resource('savings',     ['controller' => 'SavingsController']);
    $r->resource('shares',      ['controller' => 'ShareController']);

    // Accounting & Audit
    $r->resource('accounting',  ['controller' => 'AccountingController']);
    $r->resource('audit-log',   ['controller' => 'AuditLogController']);

    // Notifications
    $r->resource('notif-rules', ['controller' => 'NotificationAdminController']);
    $r->get('notifications',    'NotificationController::index');
    $r->post('notifications/send-pending', 'NotificationController::sendPending');

    // Assets & Expenses
    $r->resource('assets',      ['controller' => 'AssetController']);
    $r->resource('expenses',    ['controller' => 'ExpenseController']);
});

