<?php

namespace App\Controllers;

use App\Models\BudgetModel;
use App\Models\CategoryModel;

class Budgets extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        $budgets = $db->table('budgets')
            ->select('budgets.*, categories.name as category_name')
            ->join('categories', 'categories.id = budgets.category_id')
            ->orderBy('year', 'DESC')
            ->orderBy('month', 'DESC')
            ->get()
            ->getResultArray();

        return view('budgets/index', [
            'budgets' => $budgets
        ]);
    }

    public function create()
    {
        $categoryModel = new CategoryModel();

        return view('budgets/create', [
            'categories' => $categoryModel->findAll()
        ]);
    }

    public function store()
    {
        $model = new BudgetModel();

        $model->save([
            'category_id' => $this->request->getPost('category_id'),
            'month' => $this->request->getPost('month'),
            'year' => $this->request->getPost('year'),
            'amount' => $this->request->getPost('amount'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/budgets')
            ->with('success', 'Budget created');
    }

    public function edit($id)
    {
        $budgetModel = new BudgetModel();
        $categoryModel = new CategoryModel();

        return view('budgets/edit', [
            'budget' => $budgetModel->find($id),
            'categories' => $categoryModel->findAll()
        ]);
    }

    public function update($id)
    {
        $model = new BudgetModel();

        $model->update($id, [
            'category_id' => $this->request->getPost('category_id'),
            'month' => $this->request->getPost('month'),
            'year' => $this->request->getPost('year'),
            'amount' => $this->request->getPost('amount')
        ]);

        return redirect()->to('/budgets')
            ->with('success', 'Budget updated');
    }

    public function delete($id)
    {
        $model = new BudgetModel();

        $model->delete($id);

        return redirect()->to('/budgets')
            ->with('success', 'Budget deleted');
    }
}