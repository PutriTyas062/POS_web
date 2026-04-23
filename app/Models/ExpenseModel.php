<?php

namespace App\Models;

use CodeIgniter\Model;

class ExpenseModel extends Model
{
    protected $table = 'expenses';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = [
        'tanggal',
        'category',
        'deskripsi',
        'nominal',
        'pengguna',
        'lampiran'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getTodayExpenses()
    {
        $today = date('Y-m-d');
        return $this->where('DATE(tanggal)', $today)
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }

    public function getTotalExpensesToday()
    {
        $today = date('Y-m-d');
        $builder = $this->db->table('expenses');
        $builder->selectSum('nominal', 'total');
        $builder->where('DATE(tanggal)', $today);
        return $builder->get()->getRowArray();
    }

    public function getExpensesByPeriod($start_date, $end_date)
    {
        return $this->where('tanggal >=', $start_date . ' 00:00:00')
            ->where('tanggal <=', $end_date . ' 23:59:59')
            ->orderBy('tanggal', 'DESC')
            ->findAll();
    }
}
