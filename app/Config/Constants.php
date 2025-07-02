<?php

/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 */
defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');

/*
 | --------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 | --------------------------------------------------------------------
 | Timing Constants
 | --------------------------------------------------------------------
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0);   // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1);     // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3);    // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4);
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5);
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6);
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7);
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8);
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9);
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125);

/*
 | --------------------------------------------------------------------
 | Business Domain Constants
 | --------------------------------------------------------------------
 | Replace the numeric values below with the actual IDs after seeding
 | your lookup tables so they stay in sync.
 */

/* FrequencyLookup */
defined('FREQ_WEEKLY')   || define('FREQ_WEEKLY',   1);
defined('FREQ_MONTHLY')  || define('FREQ_MONTHLY',  2);
// defined('FREQ_BIWEEKLY') || define('FREQ_BIWEEKLY', 3);
// …add other frequencies as seeded…

/* Channel */
defined('CHANNEL_SMS')    || define('CHANNEL_SMS',    1);
defined('CHANNEL_EMAIL')  || define('CHANNEL_EMAIL',  2);
// …add any other channels…

/* NotificationEventType */
defined('EVENT_LOAN_DUE')      || define('EVENT_LOAN_DUE',      1);
defined('EVENT_REPAYMENT')     || define('EVENT_REPAYMENT',     2);
// …add other event types…

/* NotificationStatus */
defined('NOTIF_PENDING') || define('NOTIF_PENDING', 1);
defined('NOTIF_SENT')    || define('NOTIF_SENT',    2);
defined('NOTIF_FAILED')  || define('NOTIF_FAILED',  3);

/* ContactType */
defined('CT_EMAIL')      || define('CT_EMAIL',      1);
defined('CT_PHONE')      || define('CT_PHONE',      2);
defined('CT_MOBILE')     || define('CT_MOBILE',     3);
// …add any other contact types…

/* MaritalStatusLookup */
defined('MS_SINGLE')     || define('MS_SINGLE',     1);
defined('MS_MARRIED')    || define('MS_MARRIED',    2);
defined('MS_DIVORCED')   || define('MS_DIVORCED',   3);
// …add other marital statuses…

/* GenderLookup */
defined('GENDER_MALE')   || define('GENDER_MALE',   1);
defined('GENDER_FEMALE') || define('GENDER_FEMALE', 2);
// defined('GENDER_OTHER')  || define('GENDER_OTHER',  3);

/* MemberStatusLookup */
defined('MEM_ACTIVE')    || define('MEM_ACTIVE',    1);
defined('MEM_INACTIVE')  || define('MEM_INACTIVE',  2);
// defined('MEM_SUSPENDED')|| define('MEM_SUSPENDED',3);

/* LoanStatus */
defined('LOAN_PENDING')  || define('LOAN_PENDING',  1);
defined('LOAN_APPROVED') || define('LOAN_APPROVED', 2);
defined('LOAN_PAID')     || define('LOAN_PAID',     3);
// …add other loan statuses…

/* PaymentType */
defined('PT_PRINCIPAL')  || define('PT_PRINCIPAL',  1);
defined('PT_INTEREST')   || define('PT_INTEREST',   2);
// …add other payment types…

/* PaymentMethod */
defined('PM_CASH')          || define('PM_CASH',          1);
defined('PM_MOBILE_MONEY')  || define('PM_MOBILE_MONEY',  2);
defined('PM_BANK_TRANSFER') || define('PM_BANK_TRANSFER', 3);
// …add other payment methods…

/* ScheduleStatus */
defined('SCH_PENDING')   || define('SCH_PENDING',   1);
defined('SCH_PAID')      || define('SCH_PAID',      2);
defined('SCH_OVERDUE')   || define('SCH_OVERDUE',   3);
// …add other schedule statuses…

/* ExpenseCategory */
defined('EXP_OFFICE')    || define('EXP_OFFICE',    1);
defined('EXP_TRAVEL')    || define('EXP_TRAVEL',    2);
defined('EXP_UTILITY')   || define('EXP_UTILITY',   3);
// defined('EXP_OTHER')     || define('EXP_OTHER',     4);

/* Roles */
defined('ROLE_ADMIN')    || define('ROLE_ADMIN',    1);
defined('ROLE_OFFICER')  || define('ROLE_OFFICER',  2);
// defined('ROLE_MEMBER')   || define('ROLE_MEMBER',   3);
// …add any additional roles…

/* GL Modules (for AccountingEntry.module_id) */
defined('GL_SAVINGS') || define('GL_SAVINGS', 1);
defined('GL_LOAN')    || define('GL_LOAN',    2);
defined('GL_SHARE')   || define('GL_SHARE',   3);
defined('GL_ASSET')   || define('GL_ASSET',   4);
defined('GL_EXPENSE') || define('GL_EXPENSE', 5);

/* ChartOfAccounts codes (replace with your actual codes) */
defined('COA_CASH')             || define('COA_CASH',             '101');
defined('COA_LOAN_RECEIVABLE')  || define('COA_LOAN_RECEIVABLE',  '201');
defined('COA_DEP_EXPENSE')      || define('COA_DEP_EXPENSE',      '301');
defined('COA_ACCUM_DEP')        || define('COA_ACCUM_DEP',        '302');
// …add additional COA codes…

/*
 | --------------------------------------------------------------------
 | Any additional business-specific lookup constants can go below:
 | - ContactType (if more)
 | - MaritalStatusLookup (if more)
 | - GenderLookup (if more)
 | - MemberStatusLookup (if more)
 | - LoanStatus (if more)
 | - PaymentMethod (if more)
 | - ExpenseCategory (if more)
 | - Other domain tables…
 | --------------------------------------------------------------------
 */
