<?php

namespace App\Models;

use CodeIgniter\Model;

class BillModel extends Model
{
    protected $table = 'bills';

    protected $allowedFields = [
        'name',
        'amount',
        'due_date',
        'status',
        'month',
        'year'
    ];
}