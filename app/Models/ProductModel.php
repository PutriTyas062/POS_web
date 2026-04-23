<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'product_code',
        'product_name',
        'category',
        'unit',
        'purchase_price',
        'selling_price',
        'stock',
        'min_stock',
        'image',
        'status'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getActiveProducts()
    {
        return $this->where('status', 'AKTIF')->findAll();
    }

    public function getProductsByCategory($category)
    {
        return $this->where('category', $category)
            ->where('status', 'AKTIF')
            ->findAll();
    }

    public function getLowStockProducts()
    {
        return $this->where('stock <', "{min_stock}")
            ->where('status', 'AKTIF')
            ->findAll();
    }

    public function decreaseStock($id, $quantity)
    {
        $product = $this->find($id);
        if ($product && $product['stock'] >= $quantity) {
            $newStock = $product['stock'] - $quantity;
            $this->update($id, ['stock' => $newStock]);
            return true;
        }
        return false;
    }
}
