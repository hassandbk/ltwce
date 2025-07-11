<?php

declare(strict_types=1);

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException; // For 404 handling if content isn't found

/**
 * Class Resources
 *
 * Handles public-facing pages providing various resources such as FAQs, downloads,
 * policies & legal documents, news articles, and testimonials.
 *
 * @package App\Controllers
 */
class Resources extends BaseFrontendController
{
  // --- Membership Hub ---

  /**
   * Displays the Frequently Asked Questions (FAQs) page.
   */
  public function faqs(): void
  {
    $this->renderPage(
      'resources/membership_hub/faqs', // Corresponding view file: app/Views/resources/membership_hub/faqs.php
      ['title' => 'LTWCE – FAQs']
    );
  }

  // --- Downloads / Forms ---

  /**
   * Displays the Membership Application form page.
   */
  public function membershipApplication(): void
  {
    $this->renderPage(
      'resources/downloads/membership_application', // Corresponding view file: app/Views/resources/downloads/membership_application.php
      ['title' => 'LTWCE – Membership Application']
    );
  }

  /**
   * Displays the Loan Application Forms page.
   */
  public function loanApplicationForms(): void
  {
    $this->renderPage(
      'resources/downloads/loan_application_forms', // Corresponding view file: app/Views/resources/downloads/loan_application_forms.php
      ['title' => 'LTWCE – Loan Application Forms']
    );
  }

  /**
   * Displays the Savings Account Opening page.
   */
  public function savingsAccountOpening(): void
  {
    $this->renderPage(
      'resources/downloads/savings_account_opening', // Corresponding view file: app/Views/resources/downloads/savings_account_opening.php
      ['title' => 'LTWCE – Savings Account Opening']
    );
  }

  /**
   * Displays the Withdrawal Forms page.
   */
  public function withdrawalForms(): void
  {
    $this->renderPage(
      'resources/downloads/withdrawal_forms', // Corresponding view file: app/Views/resources/downloads/withdrawal_forms.php
      ['title' => 'LTWCE – Withdrawal Forms']
    );
  }

  /**
   * Displays the KYC Documents Checklist page.
   */
  public function kycDocumentsChecklist(): void
  {
    $this->renderPage(
      'resources/downloads/kyc_documents_checklist', // Corresponding view file: app/Views/resources/downloads/kyc_documents_checklist.php
      ['title' => 'LTWCE – KYC Documents Checklist']
    );
  }

  // --- Policies & Legal ---

  /**
   * Displays the Privacy Policy page.
   */
  public function privacyPolicy(): void
  {
    $this->renderPage(
      'resources/policies/privacy_policy', // Corresponding view file: app/Views/resources/policies/privacy_policy.php
      ['title' => 'LTWCE – Privacy Policy']
    );
  }

  /**
   * Displays the Terms & Conditions page.
   */
  public function termsConditions(): void
  {
    $this->renderPage(
      'resources/policies/terms_conditions', // Corresponding view file: app/Views/resources/policies/terms_conditions.php
      ['title' => 'LTWCE – Terms & Conditions']
    );
  }

  /**
   * Displays the Loan Policy page.
   */
  public function loanPolicy(): void
  {
    $this->renderPage(
      'resources/policies/loan_policy', // Corresponding view file: app/Views/resources/policies/loan_policy.php
      ['title' => 'LTWCE – Loan Policy']
    );
  }

  /**
   * Displays the Savings Policy page.
   */
  public function savingsPolicy(): void
  {
    $this->renderPage(
      'resources/policies/savings_policy', // Corresponding view file: app/Views/resources/policies/savings_policy.php
      ['title' => 'LTWCE – Savings Policy']
    );
  }

  /**
   * Displays the Complaint Resolution page.
   */
  public function complaintResolution(): void
  {
    $this->renderPage(
      'resources/policies/complaint_resolution', // Corresponding view file: app/Views/resources/policies/complaint_resolution.php
      ['title' => 'LTWCE – Complaint Resolution']
    );
  }

  // --- News & Articles ---

  /**
   * Displays a list of news articles.
   */
  public function newsArticles(): void
  {
    // You would typically fetch articles from a model here.
    // Example: $articles = model('ArticleModel')->getRecent(10);

    $this->renderPage(
      'resources/articles/index', // View file: app/Views/resources/articles/index.php
      [
        'title' => 'LTWCE – News & Articles',
        // 'articles' => $articles, // Pass data to the view
      ],
      [],
      [
        'articles-list-app.js', // Example JS specific to this page
      ]
    );
  }

  public function allArticles(): void
  {
    // You would typically fetch articles from a model here.
    // Example: $articles = model('ArticleModel')->getRecent(10);

    $this->renderPage(
      'resources/articles/all_articles',
      [
        'title' => 'LTWCE – News & Articles',
        // 'articles' => $articles, // Pass data to the view
      ],
      [],
      [
        'all-articles-app.js', // Example JS specific to this page
      ]
    );
  }
  /**
   * Displays a single news article by its slug.
   *
   * @param string $slug The URL slug of the article.
   * @throws PageNotFoundException If the article is not found.
   */
  public function articleDetails(string $slug): void
  {
    // Example: Fetch a single article by slug. Replace with your actual model logic.
    // $article = model('ArticleModel')->findBySlug($slug);

    // if ($article === null) {
    //     throw PageNotFoundException::forPageNotFound('Sorry, the article you requested could not be found.');
    // }

    $this->renderPage(
      'resources/articles/detail', // View file: app/Views/resources/articles/detail.php
      [
        'title' => 'LTWCE – ' . ucwords(str_replace('-', ' ', $slug)), // Fallback title or use $article->title
        // 'article' => $article, // Pass article data to the view
      ],
      [],
      [
        'single-article-app.js', // Example JS specific to this page
      ]
    );
  }

  /**
   * Displays the Testimonials page, showcasing feedback from satisfied members.
   * Moved from Home controller.
   */
  public function testimonials(): void
  {
    // It's a good practice to fetch testimonials from a model here.
    // Example: $testimonials = model('TestimonialModel')->getAllActive();

    $this->renderPage(
      'resources/testimonials', // View file: app/Views/resources/testimonials.php (UPDATED PATH)
      [
        'title' => 'LTWCE – Wall of Love',
        'subtitle' => 'Hear What Our Members Say About Us',
        // 'testimonials' => $testimonials, // Pass testimonial data to the view
      ],
      [],
      [
        'testimonials.js', // Specific JS for testimonials if needed
        'investors-app.js', // If you have something related to investors testimonials/logos
      ]
    );
  }
}