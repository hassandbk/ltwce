<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    public string $fromEmail   = env('EMAIL_FROM', 'no-reply@your-domain.com');
    public string $fromName    = env('EMAIL_NAME',  'Microfinance App');
    public string $protocol    = 'smtp';
    public string $SMTPHost    = env('SMTP_HOST');
    public string $SMTPUser    = env('SMTP_USER');
    public string $SMTPPass    = env('SMTP_PASS');
    public int    $SMTPPort    = (int) env('SMTP_PORT', 587);
    public string $SMTPCrypto  = 'tls';
    public bool   $SMTPKeepAlive = false;
    public string $mailType    = 'html';
    public bool   $validate    = true;
    public string $CRLF        = "\r\n";
    public string $newline     = "\r\n";
}
