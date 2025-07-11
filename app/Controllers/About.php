<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Class About
 *
 * Handles public-facing pages related to the "About Us" section,
 * including company history, mission, values, team structure, careers, partnership information,
 * and contact details.
 *
 * @package App\Controllers
 */
class About extends BaseFrontendController
{
  /**
   * Displays the "Our Story" page.
   */
  public function ourStory(): void
  {
    $this->renderPage(
      'about/our_story', // Corresponding view file: app/Views/about/our_story.php
      ['title' => 'LTWCE – Our Story']
    );
  }

  /**
   * Displays the "Mission & Values" page.
   */
  public function missionValues(): void
  {
    $this->renderPage(
      'about/mission_values', // Corresponding view file: app/Views/about/mission_values.php
      ['title' => 'LTWCE – Mission & Values']
    );
  }

  // --- Our Team Sub-menu ---

  /**
   * Displays the Leadership Team page.
   */
  public function leadershipTeam(): void
  {
    $this->renderPage(
      'about/team/leadership_team', // Corresponding view file: app/Views/about/team/leadership_team.php
      ['title' => 'LTWCE – Leadership Team']
    );
  }

  /**
   * Displays the Board Members page.
   */
  public function boardMembers(): void
  {
    $this->renderPage(
      'about/team/board_members', // Corresponding view file: app/Views/about/team/board_members.php
      ['title' => 'LTWCE – Board Members']
    );
  }

  /**
   * Displays the Management Team page.
   */
  public function management(): void
  {
    $this->renderPage(
      'about/team/management', // Corresponding view file: app/Views/about/team/management.php
      ['title' => 'LTWCE – Management Team']
    );
  }

  // --- Other About Sections ---

  /**
   * Displays the Careers page.
   */
  public function careers(): void
  {
    $this->renderPage(
      'about/careers', // Corresponding view file: app/Views/about/careers.php
      ['title' => 'LTWCE – Careers']
    );
  }

  /**
   * Displays the Partnership Opportunities page.
   */
  public function partnership(): void
  {
    $this->renderPage(
      'about/partnership', // Corresponding view file: app/Views/about/partnership.php
      ['title' => 'LTWCE – Partnership Opportunities']
    );
  }

  /**
   * Displays the "Contact Us" page, providing contact information and a form.
   * Moved from Home controller.
   */
  public function contactUs(): void
  {
    $this->renderPage(
      'about/contact_us', // View file: app/Views/about/contact_us.php (UPDATED PATH)
      [
        'title' => 'LTWCE – Contact Us',
        'subtitle' => 'Get in Touch with LTWCE SACCO',
        // You might pass contact details from a configuration or database
        // 'address' => '123 Sacco Street, Kampala, Uganda',
        // 'phone' => '+256 7XX XXX XXX',
        // 'email' => 'info@ltwcesacco.org',
      ],
      [],
      [
        'contact-form-app.js', // Assuming a JavaScript file for handling the contact form
      ]
    );
  }
}