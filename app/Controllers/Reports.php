<?php

namespace App\Controllers;

class Reports extends BaseController
{
    public function monthly()
    {
        $db = \Config\Database::connect();

        $role = session()->get('role');
        $userId = session()->get('user_id');

        $month = $this->request->getGet('month') ?? date('m');
        $year  = $this->request->getGet('year') ?? date('Y');

        /*
        |--------------------------------------------------------------------------
        | BASE QUERY
        |--------------------------------------------------------------------------
        */
        $builder = $db->table('transactions')
            ->select('type, SUM(amount) as total')
            ->where('MONTH(transaction_date)', $month)
            ->where('YEAR(transaction_date)', $year)
            ->groupBy('type');

        /*
        |--------------------------------------------------------------------------
        | ROLE FILTER (SAFE, NO BREAK EXISTING SYSTEM)
        |--------------------------------------------------------------------------
        */
        if ($role !== 'SUPERADMIN') {
            $builder->groupStart()
                ->where('scope', 'shared')
                ->orGroupStart()
                    ->where('scope', 'personal')
                    ->where('user_id', $userId)
                ->groupEnd()
            ->groupEnd();
        }

        $data = $builder->get()->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | DEFAULT VALUE
        |--------------------------------------------------------------------------
        */
        $income = 0;
        $expense = 0;

        foreach ($data as $row) {
            if ($row['type'] === 'income') {
                $income = $row['total'];
            }

            if ($row['type'] === 'expense') {
                $expense = $row['total'];
            }
        }

        $balance = $income - $expense;

        return view('reports/monthly', [
            'income' => $income,
            'expense' => $expense,
            'balance' => $balance,
            'month' => $month,
            'year' => $year
        ]);
    }
}