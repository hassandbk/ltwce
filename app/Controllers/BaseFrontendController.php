<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\View\View; // Make sure View is imported if you use it directly

/**
 * Class BaseFrontendController
 *
 * Base controller for all public-facing pages, providing common rendering logic
 * including default JavaScript assets and layout integration.
 *
 * @package App\Controllers
 */
class BaseFrontendController extends Controller
{
  /**
   * @var array<string> Default JavaScript helpers/utilities to include on every page.
   */
  protected array $defaultHelperScripts = [
    'assets/js/helpers/api.js',
    'assets/js/helpers/pagination.js',
    'assets/js/helpers/validation.js',
    'assets/js/utils/dom.js',
    'assets/js/utils/format.js',
  ];

  /**
   * @var array<string> Default JavaScript component assets to include on every page.
   */
  protected array $defaultComponentScripts = [
    'assets/js/components/auth-modal-app.js',
  ];

  /**
   * Renders the requested view within the main layout.
   *
   * @param string        $view        The view path (e.g. 'home/index', 'products/loans/personal_loans').
   * @param array<mixed>  $data        Additional data to pass into the view.
   * @param array<string> $styles      CSS asset paths (relative to base_url).
   * @param array<string> $scripts     JS component asset paths (relative to assets/js/components).
   */
  protected function renderPage(
    string $view,
    array $data = [],
    array $styles = [],
    array $scripts = []
  ): void {
    // Base path for JS component assets
    $jsComponentBasePath = 'assets/js/components/';

    // Prepend the base path to each script in the $scripts array (for components)
    $componentScripts = array_map(function ($script) use ($jsComponentBasePath) {
      // Only prepend if it's not already a full path (e.g., if you add an external script or already full path)
      return strpos($script, '.js') !== false && strpos($script, '/') === false ? $jsComponentBasePath . $script : $script;
    }, $scripts);

    // Default data that every page should have
    $defaults = [
      'title' => 'LTWCE',
      'subtitle' => '',
      'description' => 'LTWCE SACCO – Empowering Communities Through Financial Inclusion',
      'keywords' => 'LTWCE, SACCO, financial inclusion, community empowerment,
                            savings, loans, microfinance, cooperative',
    ];

    // Merge defaults with any view-specific data
    $data = array_merge($defaults, $data);

    echo view('layouts/main_layout', [
      'data' => $data,
      'styles' => $styles,
      'helper_scripts' => $this->defaultHelperScripts,
      'component_scripts' => array_merge($this->defaultComponentScripts, $componentScripts),
      // Nest the page content view inside the layout
      'content' => view($view, $data),
    ]);
  }
}