<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['products'] = $this->productModel->findAll();
        $data['title'] = 'Daftar Barang';

        return view('products/index', $data);
    }

    public function create()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['title'] = 'Tambah Barang';
        return view('products/create', $data);
    }

    public function store()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $productData = [
            'product_code' => $this->request->getPost('product_code'),
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'unit' => $this->request->getPost('unit'),
            'purchase_price' => $this->request->getPost('purchase_price'),
            'selling_price' => $this->request->getPost('selling_price'),
            'stock' => $this->request->getPost('stock'),
            'min_stock' => $this->request->getPost('min_stock'),
            'status' => 'AKTIF',
        ];

        if ($this->productModel->insert($productData)) {
            session()->setFlashdata('success', 'Barang berhasil ditambahkan');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan barang');
        }

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['product'] = $this->productModel->find($id);
        $data['title'] = 'Edit Barang';

        return view('products/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $productData = [
            'product_name' => $this->request->getPost('product_name'),
            'category' => $this->request->getPost('category'),
            'unit' => $this->request->getPost('unit'),
            'purchase_price' => $this->request->getPost('purchase_price'),
            'selling_price' => $this->request->getPost('selling_price'),
            'stock' => $this->request->getPost('stock'),
            'min_stock' => $this->request->getPost('min_stock'),
        ];

        if ($this->productModel->update($id, $productData)) {
            session()->setFlashdata('success', 'Barang berhasil diperbarui');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui barang');
        }

        return redirect()->to('/products');
    }

    public function delete($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        if ($this->productModel->delete($id)) {
            session()->setFlashdata('success', 'Barang berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus barang');
        }

        return redirect()->to('/products');
    }

    public function toggleStatus($id)
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['status' => 'error']);
        }

        $product = $this->productModel->find($id);
        $newStatus = $product['status'] === 'AKTIF' ? 'NONAKTIF' : 'AKTIF';

        $this->productModel->update($id, ['status' => $newStatus]);
        return $this->response->setJSON(['status' => 'success', 'new_status' => $newStatus]);
    }
}
