<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false); // Keep false for exact URL matching from nav
$routes->set404Override('App\Controllers\Errors::show404');
$routes->setAutoRoute(false); // Crucial for explicit routing

// --- Public Facing Routes ---
// Grouping public routes with their common namespace 'App\Controllers'
$routes->group('', ['namespace' => 'App\Controllers'], function ($r) {

    // Home Controller routes
    $r->get('/', 'Home::index');
    $r->get('services', 'Home::services'); // Moved from generic 'pages' to 'Home' controller
    $r->get('support', 'Home::support');   // Moved from generic 'pages' to 'Home' controller
    $r->get('request-demo', 'Home::requestDemo'); // Moved from generic 'pages' to 'Home' controller


    // Products Controller routes (No change in routes)
    $r->group('products', function ($r) {
        // Loans
        $r->get('loans/personal', 'Products::personalLoans');
        $r->get('loans/business', 'Products::businessLoans');
        $r->get('loans/education', 'Products::educationLoans');
        $r->get('loans/microfinance', 'Products::microfinanceLoans');

        // Savings Accounts
        $r->get('savings/ordinary', 'Products::ordinarySavings');
        $r->get('savings/fixed', 'Products::fixedDeposit');
        $r->get('savings/junior', 'Products::juniorSavings');

        // Other Products
        $r->get('shares', 'Products::shareCapital');
        $r->get('insurance', 'Products::insuranceProducts');
    });

    // Resources Controller routes
    $r->group('resources', function ($r) {
        // Membership Hub
        $r->get('membership-hub/faqs', 'Resources::faqs');

        // Downloads/Forms
        $r->get('downloads/membership-application', 'Resources::membershipApplication');
        $r->get('downloads/loan-application', 'Resources::loanApplicationForms');
        $r->get('downloads/savings-opening', 'Resources::savingsAccountOpening');
        $r->get('downloads/withdrawal-forms', 'Resources::withdrawalForms');
        $r->get('downloads/kyc-checklist', 'Resources::kycDocumentsChecklist');

        // Policies & Legal
        $r->get('policies/privacy-policy', 'Resources::privacyPolicy');
        $r->get('policies/terms-conditions', 'Resources::termsConditions');
        $r->get('policies/loan-policy', 'Resources::loanPolicy');
        $r->get('policies/savings-policy', 'Resources::savingsPolicy');
        $r->get('policies/complaint-resolution', 'Resources::complaintResolution');

        // News & Articles
        // News & Articles
        $r->get('articles', 'Resources::newsArticles'); // For a landing/featured articles page
        $r->get('articles/all', 'Resources::allArticles'); // For the full list of articles -- MOVED UP
        $r->get('articles/(:segment)', 'Resources::articleDetails/$1'); // Individual article -- MOVED DOWN

        // Testimonials (MOVED HERE from Home controller)
        $r->get('testimonials', 'Resources::testimonials');
    });

    // About Controller routes
    $r->group('about', function ($r) {
        $r->get('our-story', 'About::ourStory');
        $r->get('mission-values', 'About::missionValues');

        // Our Team
        $r->group('team', function ($r) {
            $r->get('leadership', 'About::leadershipTeam');
            $r->get('board', 'About::boardMembers');
            $r->get('management', 'About::management');
        });

        // Other About Us sections
        $r->get('careers', 'About::careers');
        $r->get('partnership', 'About::partnership');

        // Contact Us (MOVED HERE from Home controller)
        $r->get('contact', 'About::contactUs');
    });

    // --- Authentication Routes (Highly Recommended to keep in AuthController) ---
    // If you absolutely need these in the Home controller, you'd change the target.
    // However, it's a security and organizational best practice to keep auth separate.
    $r->get('auth/login', 'AuthController::showLogin');
    $r->post('auth/login', 'AuthController::attemptLogin');
    $r->get('auth/signup', 'AuthController::showSignup');
    $r->post('auth/signup', 'AuthController::attemptSignup');
    $r->get('auth/logout', 'AuthController::logout', ['filter' => 'auth']);
});


// --- Protected (admin) routes (keep these separated by 'auth' filter) ---
$routes->group('', ['filter' => 'auth'], function ($r) {
    // Admin dashboard (example)
    $r->get('dashboard', 'DashboardController::index');

    // Resources for CRUD operations (assuming these are for logged-in users/admin)
    $r->resource('roles', ['controller' => 'RoleController']);
    $r->resource('users', ['controller' => 'UserController']);
    $r->resource('permissions', ['controller' => 'PermissionController']);
    $r->resource('members', ['controller' => 'MemberController']);
    $r->resource('groups', ['controller' => 'GroupController']);
    $r->resource('officers', ['controller' => 'FieldOfficerController']);
    $r->resource('loans', ['controller' => 'LoanController']);
    $r->post('loans/(:segment)/approve', 'LoanController::approve/$1');
    $r->post('loans/(:segment)/repay', 'LoanController::repay/$1');
    $r->resource('savings', ['controller' => 'SavingsController']);
    $r->resource('shares', ['controller' => 'ShareController']);
    $r->resource('accounting', ['controller' => 'AccountingController']);
    $r->resource('audit-log', ['controller' => 'AuditLogController']);
    $r->resource('notif-rules', ['controller' => 'NotificationAdminController']);
    $r->get('notifications', 'NotificationController::index');
    $r->post('notifications/send-pending', 'NotificationController::sendPending');
    $r->resource('assets', ['controller' => 'AssetController']);
    $r->resource('expenses', ['controller' => 'ExpenseController']);
});