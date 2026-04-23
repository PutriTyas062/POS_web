<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['users'] = $this->userModel->findAll();
        $data['title'] = 'Pengaturan User';

        return view('users/index', $data);
    }

    public function create()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['title'] = 'Tambah User';
        return view('users/create', $data);
    }

    public function store()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $userData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('password'),
            'full_name' => $this->request->getPost('full_name'),
            'role' => $this->request->getPost('role'),
            'status' => 'active',
        ];

        if ($this->userModel->insert($userData)) {
            session()->setFlashdata('success', 'User berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan user');
        }

        return redirect()->to('/users');
    }

    public function edit($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['user'] = $this->userModel->find($id);
        $data['title'] = 'Edit User';

        return view('users/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $userData = [
            'full_name' => $this->request->getPost('full_name'),
            'role' => $this->request->getPost('role'),
            'status' => $this->request->getPost('status'),
        ];

        if ($this->userModel->update($id, $userData)) {
            session()->setFlashdata('success', 'User berhasil diperbarui');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui user');
        }

        return redirect()->to('/users');
    }

    public function delete($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'User berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus user');
        }

        return redirect()->to('/users');
    }

    public function toggleStatus($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['status' => 'error']);
        }

        $user = $this->userModel->find($id);
        $newStatus = $user['status'] === 'active' ? 'inactive' : 'active';

        $this->userModel->update($id, ['status' => $newStatus]);
        return $this->response->setJSON(['status' => 'success', 'new_status' => $newStatus]);
    }
}
