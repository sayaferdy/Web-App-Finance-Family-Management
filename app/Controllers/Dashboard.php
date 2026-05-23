<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $role = session()->get('role');
        $userId = session()->get('user_id');

        /*
        |--------------------------------------------------------------------------
        | SHARED TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $shared = $db->table('transactions')
            ->select('transactions.*, categories.name as category_name, users.name as user_name')
            ->join('categories', 'categories.id = transactions.category_id', 'left')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->where('scope', 'shared')
            ->orderBy('transaction_date', 'DESC')
            ->get()
            ->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | PERSONAL TRANSACTIONS
        |--------------------------------------------------------------------------
        */

        $personalBuilder = $db->table('transactions')
            ->select('transactions.*, categories.name as category_name, users.name as user_name')
            ->join('categories', 'categories.id = transactions.category_id', 'left')
            ->join('users', 'users.id = transactions.user_id', 'left')
            ->where('scope', 'personal');

        /*
        |--------------------------------------------------------------------------
        | SUPERADMIN -> semua personal
        |--------------------------------------------------------------------------
        */

        if ($role !== 'SUPERADMIN') {
            $personalBuilder->where('user_id', $userId);
        }

        $personal = $personalBuilder
            ->orderBy('transaction_date', 'DESC')
            ->get()
            ->getResultArray();

        /*
        |--------------------------------------------------------------------------
        | SHARED SUMMARY
        |--------------------------------------------------------------------------
        */

        $sharedIncome = $db->table('transactions')
            ->selectSum('amount')
            ->where('scope', 'shared')
            ->where('type', 'income')
            ->get()
            ->getRow()
            ->amount ?? 0;

        $sharedExpense = $db->table('transactions')
            ->selectSum('amount')
            ->where('scope', 'shared')
            ->where('type', 'expense')
            ->get()
            ->getRow()
            ->amount ?? 0;

        $sharedBalance = $sharedIncome - $sharedExpense;

        /*
        |--------------------------------------------------------------------------
        | PERSONAL SUMMARY
        |--------------------------------------------------------------------------
        */

        $personalIncomeBuilder = $db->table('transactions')
            ->selectSum('amount')
            ->where('scope', 'personal')
            ->where('type', 'income');

        $personalExpenseBuilder = $db->table('transactions')
            ->selectSum('amount')
            ->where('scope', 'personal')
            ->where('type', 'expense');

        /*
        |--------------------------------------------------------------------------
        | SUPERADMIN -> semua personal
        |--------------------------------------------------------------------------
        */

        if ($role !== 'SUPERADMIN') {

            $personalIncomeBuilder->where('user_id', $userId);

            $personalExpenseBuilder->where('user_id', $userId);
        }

        $personalIncome = $personalIncomeBuilder
            ->get()
            ->getRow()
            ->amount ?? 0;

        $personalExpense = $personalExpenseBuilder
            ->get()
            ->getRow()
            ->amount ?? 0;

        $personalBalance = $personalIncome - $personalExpense;

        return view('dashboard/index', [
            'shared' => $shared,
            'personal' => $personal,

            'sharedIncome' => $sharedIncome,
            'sharedExpense' => $sharedExpense,
            'sharedBalance' => $sharedBalance,

            'personalIncome' => $personalIncome,
            'personalExpense' => $personalExpense,
            'personalBalance' => $personalBalance
        ]);
    }
}