<?php

namespace App\Controllers;

use App\Models\BillModel;

class Bills extends BaseController
{
    public function index()
    {
        $model = new BillModel();

        return view('bills/index', [
            'bills' => $model->orderBy('due_date', 'ASC')->findAll()
        ]);
    }

    public function create()
    {
        return view('bills/create');
    }

    public function store()
    {
        $model = new BillModel();

        $model->save([
            'name' => $this->request->getPost('name'),
            'amount' => $this->request->getPost('amount'),
            'due_date' => $this->request->getPost('due_date'),
            'status' => $this->request->getPost('status'),
            'month' => date('m'),
            'year' => date('Y'),
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/bills')
            ->with('success', 'Bill created');
    }

    public function edit($id)
    {
        $model = new BillModel();

        return view('bills/edit', [
            'bill' => $model->find($id)
        ]);
    }

    public function update($id)
    {
        $model = new BillModel();

        $model->update($id, [
            'name' => $this->request->getPost('name'),
            'amount' => $this->request->getPost('amount'),
            'due_date' => $this->request->getPost('due_date'),
            'status' => $this->request->getPost('status')
        ]);

        return redirect()->to('/bills')
            ->with('success', 'Bill updated');
    }

    public function delete($id)
    {
        $model = new BillModel();

        $model->delete($id);

        return redirect()->to('/bills')
            ->with('success', 'Bill deleted');
    }

    public function markPaid($id)
    {
        $model = new BillModel();

        $model->update($id, [
            'status' => 'paid'
        ]);

        return redirect()->to('/bills')
            ->with('success', 'Bill marked as paid');
    }

    public function markUnpaid($id)
    {
        $model = new BillModel();

        $model->update($id, [
            'status' => 'unpaid'
        ]);

        return redirect()->to('/bills')
            ->with('success', 'Bill marked as unpaid');
    }
}