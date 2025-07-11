<?php

declare(strict_types=1);

namespace App\Controllers;

/**
 * Class Products
 *
 * Handles all public-facing pages related to SACCO products,
 * including various types of loans, savings accounts, share capital, and insurance.
 *
 * @package App\Controllers
 */
class Products extends BaseFrontendController
{
  // --- Loans ---

  /**
   * Displays the Personal Loans page.
   */
  public function personalLoans(): void
  {
    $this->renderPage(
      'products/loans/personal_loans', // Corresponding view file: app/Views/products/loans/personal_loans.php
      ['title' => 'LTWCE – Personal Loans']
    );
  }

  /**
   * Displays the Business Loans page.
   */
  public function businessLoans(): void
  {
    $this->renderPage(
      'products/loans/business_loans', // Corresponding view file: app/Views/products/loans/business_loans.php
      ['title' => 'LTWCE – Business Loans']
    );
  }

  /**
   * Displays the Education Loans page.
   */
  public function educationLoans(): void
  {
    $this->renderPage(
      'products/loans/education_loans', // Corresponding view file: app/Views/products/loans/education_loans.php
      ['title' => 'LTWCE – Education Loans']
    );
  }

  /**
   * Displays the Microfinance Loans page.
   */
  public function microfinanceLoans(): void
  {
    $this->renderPage(
      'products/loans/microfinance_loans', // Corresponding view file: app/Views/products/loans/microfinance_loans.php
      ['title' => 'LTWCE – Microfinance Loans']
    );
  }

  // --- Savings Accounts ---

  /**
   * Displays the Ordinary Savings page.
   */
  public function ordinarySavings(): void
  {
    $this->renderPage(
      'products/savings/ordinary_savings', // Corresponding view file: app/Views/products/savings/ordinary_savings.php
      ['title' => 'LTWCE – Ordinary Savings']
    );
  }

  /**
   * Displays the Fixed Deposit page.
   */
  public function fixedDeposit(): void
  {
    $this->renderPage(
      'products/savings/fixed_deposit', // Corresponding view file: app/Views/products/savings/fixed_deposit.php
      ['title' => 'LTWCE – Fixed Deposit']
    );
  }

  /**
   * Displays the Junior Savings page.
   */
  public function juniorSavings(): void
  {
    $this->renderPage(
      'products/savings/junior_savings', // Corresponding view file: app/Views/products/savings/junior_savings.php
      ['title' => 'LTWCE – Junior Savings']
    );
  }

  // --- Other Products ---

  /**
   * Displays the Share Capital page.
   */
  public function shareCapital(): void
  {
    $this->renderPage(
      'products/shares/share_capital', // Corresponding view file: app/Views/products/shares/share_capital.php
      ['title' => 'LTWCE – Share Capital']
    );
  }

  /**
   * Displays the Insurance Products page.
   */
  public function insuranceProducts(): void
  {
    $this->renderPage(
      'products/insurance/insurance_products', // Corresponding view file: app/Views/products/insurance/insurance_products.php
      ['title' => 'LTWCE – Insurance Products']
    );
  }
}