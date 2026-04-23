<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionModel extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'transaction_code',
        'tanggal_jam',
        'user_id',
        'total_item',
        'subtotal',
        'discount_type',
        'discount_value',
        'ppn_percent',
        'ppn_value',
        'total_payment',
        'cash_received',
        'cash_return',
        'payment_status',
        'notes'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function generateTransactionCode()
    {
        $now = date('Y-m-d');
        $lastTransaction = $this->where('tanggal_jam >=', $now . ' 00:00:00')
            ->orderBy('id', 'DESC')
            ->first();

        $counter = 1;
        if ($lastTransaction) {
            $lastCode = $lastTransaction['transaction_code'];
            $parts = explode('-', $lastCode);
            $counter = (int)$parts[3] + 1;
        }

        $code = 'TRX-' . date('Ymd') . '-' . str_pad($counter, 3, '0', STR_PAD_LEFT);
        return $code;
    }

    public function getTodayTransactions()
    {
        $today = date('Y-m-d');
        return $this->where('DATE(tanggal_jam)', $today)
            ->orderBy('tanggal_jam', 'DESC')
            ->findAll();
    }

    public function getSummaryToday()
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('transactions');
        $builder->selectSum('total_payment', 'total_penjualan');
        $builder->selectSum('total_item', 'total_item');
        $builder->where('DATE(tanggal_jam)', $today);
        return $builder->get()->getRowArray();
    }
}
