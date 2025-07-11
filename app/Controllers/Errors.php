<?php

declare(strict_types=1);

namespace App\Controllers; // Ensure this namespace is correct

use CodeIgniter\Controller; // This import is no longer strictly necessary if extending BaseFrontendController
use Config\Services;       // Needed for setting the HTTP response code

/**
 * Class Errors
 *
 * Handles custom error pages (like 404 Not Found) by extending the BaseFrontendController
 * to ensure consistent layout and asset loading.
 *
 * @package App\Controllers
 */
class Errors extends BaseFrontendController // Extend BaseFrontendController
{
  /**
   * Displays the custom 404 "Page Not Found" error page.
   * Overrides the default CodeIgniter 404 handler configured in Config/Routes.php.
   */
  public function show404(): \CodeIgniter\HTTP\Response
  {
    // Data specific to the 404 page
    $data = [
      'title' => '404 – Page Not Found',
      'subtitle' => 'The page you requested could not be found.',
    ];

    // Styles specific to the 404 page (if any)
    $styles = [];

    // JavaScript components specific to the 404 page (unlikely, but follows pattern)
    $scripts = [];

    // Use the inherited renderPage method to render the 404 view within the main layout
    // The renderPage method handles the default scripts, styles, and merges common data.
    $this->renderPage(
      'home/404', // The specific view file for your 404 content
      $data,
      $styles,
      $scripts
    );

    // Set the HTTP status code to 404
    return Services::response()->setStatusCode(404);
    // Note: renderPage already echoes the view content, so we just set the status code.
  }

  // You can add other custom error handling methods here if needed,
  // e.g., public function show500() for server errors.
}