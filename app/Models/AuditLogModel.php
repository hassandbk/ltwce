<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditLogModel extends Model
{
    protected $table = 'AuditLog'; // Your table name

    protected $primaryKey = 'audit_id'; // Primary key

    protected $allowedFields = [
        'user_id',
        'action',
        'target_table',
        'target_id',
        'old_data',
        'new_data',
        'ip_address',
        // 'created_at' is auto-set by DB default, so no need here unless you want manual control
    ];

    // Optional: Enable automatic timestamps if your table uses created_at/updated_at
    protected $useTimestamps = false; // Set to true if you want CI to handle timestamps

    // Optional: Define date format if using timestamps
    // protected $dateFormat = 'datetime';
}
