<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\CategoryModel;

class Transactions extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $builder = $db->table('transactions');

        $builder->select('transactions.*, categories.name as category_name, users.name as user_name');
        $builder->join('categories', 'categories.id = transactions.category_id', 'left');
        $builder->join('users', 'users.id = transactions.user_id', 'left');

        $role = session()->get('role');
        $userId = session()->get('user_id');

        /*
        |--------------------------------------------------------------------------
        | SEARCH CATEGORY (NEW)
        |--------------------------------------------------------------------------
        */
        $searchCategory = $this->request->getGet('category');

        if (!empty($searchCategory)) {
            $builder->like('categories.name', $searchCategory);
        }

        /*
        |--------------------------------------------------------------------------
        | ACCESS RULE
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

        /*
        |--------------------------------------------------------------------------
        | URUTAN TERBARU (FIX PENTING)
        |--------------------------------------------------------------------------
        */
        $builder->orderBy('transactions.created_at', 'DESC');

        $query = $builder->get();

        return view('transactions/index', [
            'transactions' => $query->getResultArray(),
            'searchCategory' => $searchCategory
        ]);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();

        return view('transactions/create', [
            'categories' => $categoryModel->findAll()
        ]);
    }

    public function store()
    {
        $role = session()->get('role');
        $userId = session()->get('user_id');

        $file = $this->request->getFile('receipt');
        $filename = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads', $filename);
        }

        $scope = $this->request->getPost('scope');

        if ($role === 'MEMBER') {
            $scope = 'personal';
        }

        if (!in_array($scope, ['shared', 'personal'])) {
            $scope = 'personal';
        }

        $model = new TransactionModel();

        $model->save([
            'user_id' => $userId,
            'category_id' => $this->request->getPost('category_id'),
            'type' => $this->request->getPost('type'),
            'amount' => $this->request->getPost('amount'),
            'description' => $this->request->getPost('description'),
            'transaction_date' => $this->request->getPost('transaction_date'),
            'scope' => $scope,
            'receipt' => $filename
        ]);

        return redirect()->to('/transactions')
            ->with('success', 'Transaction saved successfully');
    }

    public function edit($id)
    {
        $db = \Config\Database::connect();

        $transaction = $db->table('transactions')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$transaction) {
            return redirect()->to('/transactions')
                ->with('error', 'Transaction not found');
        }

        $role = session()->get('role');
        $userId = session()->get('user_id');

        if ($role !== 'SUPERADMIN') {

            if (
                $transaction['scope'] === 'personal'
                && $transaction['user_id'] != $userId
            ) {
                return redirect()->to('/transactions')
                    ->with('error', 'Access denied');
            }

            if (
                $role === 'MEMBER'
                && $transaction['scope'] === 'shared'
            ) {
                return redirect()->to('/transactions')
                    ->with('error', 'Access denied');
            }
        }

        $categoryModel = new CategoryModel();

        return view('transactions/edit', [
            'transaction' => $transaction,
            'categories' => $categoryModel->findAll()
        ]);
    }

    public function update($id)
    {
        $db = \Config\Database::connect();

        $transaction = $db->table('transactions')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$transaction) {
            return redirect()->to('/transactions')
                ->with('error', 'Transaction not found');
        }

        $role = session()->get('role');
        $userId = session()->get('user_id');

        if ($role !== 'SUPERADMIN') {

            if (
                $transaction['scope'] === 'personal'
                && $transaction['user_id'] != $userId
            ) {
                return redirect()->to('/transactions')
                    ->with('error', 'Access denied');
            }

            if (
                $role === 'MEMBER'
                && $transaction['scope'] === 'shared'
            ) {
                return redirect()->to('/transactions')
                    ->with('error', 'Access denied');
            }
        }

        $file = $this->request->getFile('receipt');
        $filename = $this->request->getPost('old_receipt');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $filename = $file->getRandomName();
            $file->move('uploads', $filename);
        }

        $scope = $this->request->getPost('scope');

        if ($role === 'MEMBER') {
            $scope = 'personal';
        }

        if (!in_array($scope, ['shared', 'personal'])) {
            $scope = 'personal';
        }

        $db->table('transactions')
            ->where('id', $id)
            ->update([
                'category_id' => $this->request->getPost('category_id'),
                'type' => $this->request->getPost('type'),
                'amount' => $this->request->getPost('amount'),
                'description' => $this->request->getPost('description'),
                'transaction_date' => $this->request->getPost('transaction_date'),
                'scope' => $scope,
                'receipt' => $filename
            ]);

        return redirect()->to('/transactions')
            ->with('success', 'Transaction updated successfully');
    }

    public function delete($id)
    {
        $db = \Config\Database::connect();

        $transaction = $db->table('transactions')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$transaction) {
            return redirect()->to('/transactions')
                ->with('error', 'Transaction not found');
        }

        $role = session()->get('role');
        $userId = session()->get('user_id');

        if ($role !== 'SUPERADMIN') {

            if (
                $transaction['scope'] === 'personal'
                && $transaction['user_id'] != $userId
            ) {
                return redirect()->to('/transactions')
                    ->with('error', 'Access denied');
            }

            if (
                $role === 'MEMBER'
                && $transaction['scope'] === 'shared'
            ) {
                return redirect()->to('/transactions')
                    ->with('error', 'Access denied');
            }
        }

        $db->table('transactions')
            ->where('id', $id)
            ->delete();

        return redirect()->to('/transactions')
            ->with('success', 'Transaction deleted successfully');
    }
}