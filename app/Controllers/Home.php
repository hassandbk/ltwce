<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Class Home
 *
 * Handles the main homepage and general public pages like Services, Support, and Request a Demo.
 *
 * @package App\Controllers
 */
class Home extends BaseFrontendController
{
    /**
     * Displays the main homepage of the SACCO.
     */
    public function index(): void
    {
        // Data for the homepage, you might fetch dynamic data from models here.
        $homePageData = [
            'title' => 'LTWCE SACCO – Empowering Your Financial Journey',
            'subtitle' => 'Your Trusted Partner in Financial Growth and Community Development.',
            'hero_text' => 'Secure Your Future with Flexible Savings & Accessible Loans.',
            'call_to_action_text' => 'Join over 10,000 members benefiting from our tailored financial solutions.',
            // Example of data you might pass from a model or config:
            // 'latest_news' => model('ArticleModel')->getLatest(3),
            // 'featured_products' => model('ProductModel')->getFeatured(3),
        ];

        $this->renderPage(
            'home/index',
            $homePageData,
            [],
            [
                // JavaScript components specific to the homepage.
                // These paths are relative to 'assets/js/components/' as per BaseFrontendController.
                'solutions-grid-section.js',
                'services-carousel.js',
                'feature-tabs-app.js',
                'features-app.js',
                'features-card-app.js',
                'sacco-numbers-app.js',
                'membership-tiers-app.js',
            ]
        );
    }

    /**
     * Displays the "Our Services" page, detailing the various services offered by the SACCO.

     */
    public function services(): void
    {
        // You might fetch a list of services from a model here.
        // $services = model('ServiceModel')->getAllServices();

        $this->renderPage(
            'home/services',
            [
                'title' => 'LTWCE – Our Services',
                'subtitle' => 'Comprehensive Financial Services Tailored for You',
                // 'services' => $services,
            ],
            [],
            [
                'services-list-app.js',
            ]
        );
    }

    /**
     * Renders the Support page..
     */
    public function support(): void
    {
        $this->renderPage(
            'home/support',
            ['title' => 'LTWCE – Support'],
            [],
            ['feedback-app.js']
        );
    }

    /**
     * Renders the Demo Request page.
     * View path moved to 'home/request_demo.php'.
     */
    public function requestDemo(): void
    {
        $this->renderPage(
            'home/request_demo',
            ['title' => 'LTWCE – Request a Demo']
        );
    }
}