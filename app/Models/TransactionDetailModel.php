<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionDetailModel extends Model
{
    protected $table = 'transaction_details';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'transaction_id',
        'product_id',
        'quantity',
        'unit_price',
        'subtotal'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';

    public function getDetailsByTransactionId($transaction_id)
    {
        return $this->select('transaction_details.*, products.product_name, products.product_code')
            ->join('products', 'products.id = transaction_details.product_id')
            ->where('transaction_details.transaction_id', $transaction_id)
            ->findAll();
    }
}
