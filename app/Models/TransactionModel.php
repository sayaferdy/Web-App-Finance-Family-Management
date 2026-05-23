<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';

    protected $allowedFields = [
        'user_id',
        'category_id',
        'type',
        'amount',
        'description',
        'transaction_date',
        'scope',
        'receipt'
    ];
}