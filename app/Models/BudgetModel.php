<?php

namespace App\Models;

use CodeIgniter\Model;

class BudgetModel extends Model
{
    protected $table = 'budgets';

    protected $allowedFields = [
        'category_id',
        'month',
        'year',
        'amount'
    ];
}