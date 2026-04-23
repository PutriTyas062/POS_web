<?php

namespace App\Controllers;

use App\Models\ExpenseModel;

class Expenses extends BaseController
{
    protected $expenseModel;

    public function __construct()
    {
        $this->expenseModel = new ExpenseModel();
    }

    public function index()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $start_date = $this->request->getGet('start_date') ?? date('Y-m-d');
        $end_date = $this->request->getGet('end_date') ?? date('Y-m-d');

        $data['expenses'] = $this->expenseModel->getExpensesByPeriod($start_date, $end_date);
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['title'] = 'Pengeluaran Toko';

        return view('expenses/index', $data);
    }

    public function create()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['title'] = 'Tambah Pengeluaran';
        return view('expenses/create', $data);
    }

    public function store()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $expenseData = [
            'tanggal' => $this->request->getPost('tanggal'),
            'category' => $this->request->getPost('category'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nominal' => $this->request->getPost('nominal'),
            'pengguna' => session()->get('full_name'),
        ];

        if ($this->expenseModel->insert($expenseData)) {
            session()->setFlashdata('success', 'Pengeluaran berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan pengeluaran');
        }

        return redirect()->to('/expenses');
    }

    public function edit($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['expense'] = $this->expenseModel->find($id);
        $data['title'] = 'Edit Pengeluaran';

        return view('expenses/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $expenseData = [
            'tanggal' => $this->request->getPost('tanggal'),
            'category' => $this->request->getPost('category'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'nominal' => $this->request->getPost('nominal'),
        ];

        if ($this->expenseModel->update($id, $expenseData)) {
            session()->setFlashdata('success', 'Pengeluaran berhasil diperbarui');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui pengeluaran');
        }

        return redirect()->to('/expenses');
    }

    public function delete($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        if ($this->expenseModel->delete($id)) {
            session()->setFlashdata('success', 'Pengeluaran berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus pengeluaran');
        }

        return redirect()->to('/expenses');
    }
}
