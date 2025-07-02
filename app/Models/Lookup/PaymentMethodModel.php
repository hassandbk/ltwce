<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentMethodModel extends Model
{
    protected $table      = 'paymentmethods';
    protected $primaryKey = 'paymentmethod_id';
    // TODO: add $allowedFields, relationships, etc.
}
