<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\{Rules, FormatRules, FileRules, CreditCardRules};

class Validation extends BaseConfig
{
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // -------------------------------------------------
    // User Registration / Auth
    // -------------------------------------------------
    public array $userRegistration = [
        'username'      => 'required|alpha_numeric_space|min_length[3]|is_unique[user.username]',
        'email'         => 'required|valid_email|is_unique[user.email]',
        'password'      => 'required|min_length[8]',
        'confirm_pass'  => 'matches[password]',
    ];

    // -------------------------------------------------
    // Member Onboarding
    // -------------------------------------------------
    public array $memberOnboard = [
        'surname'           => 'required|alpha_space|max_length[50]',
        'given_name'        => 'required|alpha_space|max_length[50]',
        'nin'               => 'required|exact_length[14]|is_unique[member.nin]',
        'card_number'       => 'required|alpha_numeric|is_unique[member.card_number]',
        'gender_id'         => 'permit_empty|integer|in_list[1,2]',           // or use constants
        'dob'               => 'required|valid_date[Y-m-d]',
        'marital_status_id' => 'permit_empty|integer|in_list[1,2,3]',       // match your lookup
    ];

    // -------------------------------------------------
    // Loan Application
    // -------------------------------------------------
    public array $loanApplication = [
        'member_id'        => 'required|integer|is_not_unique[member.member_id]',
        'amount_applied'   => 'required|decimal|greater_than[0]',
        'date_applied'     => 'required|valid_date[Y-m-d]',
        'status_id'        => 'required|integer|in_list[1,2,3]',           // map to LoanStatus
    ];

    // -------------------------------------------------
    // Savings / Shares
    // -------------------------------------------------
    public array $savingsTxn = [
        'member_id' => 'required|integer|is_not_unique[member.member_id]',
        'amount'    => 'required|decimal|greater_than[0]',
        'method_id' => 'required|integer|is_not_unique[paymentmethod.method_id]',
        'txn_date'  => 'required|valid_date[Y-m-d]',
    ];

    // -------------------------------------------------
    // Expense Logging
    // -------------------------------------------------
    public array $expenseEntry = [
        'expense_date' => 'required|valid_date[Y-m-d]',
        'category_id'  => 'required|integer|is_not_unique[expensecategory.category_id]',
        'amount'       => 'required|decimal|greater_than[0]',
    ];
}
