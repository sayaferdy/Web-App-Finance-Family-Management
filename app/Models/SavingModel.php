<?php

namespace App\Models;

use CodeIgniter\Model;

class SavingModel extends Model
{
    protected $table = 'savings';

    protected $allowedFields = [
        'user_id',
        'target_name',
        'target_amount',
        'saved_amount'
    ];
}