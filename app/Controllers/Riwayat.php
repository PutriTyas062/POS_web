<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Riwayat extends BaseController
{
    protected $transactionModel;
    protected $transactionDetailModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
    }

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth');
        }

        $data['transactions'] = $this->transactionModel->getTodayTransactions();
        $data['title'] = 'Riwayat Transaksi';

        return view('riwayat/index', $data);
    }

    public function detail($transaction_id)
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth');
        }

        $transaction = $this->transactionModel->find($transaction_id);
        $details = $this->transactionDetailModel->getDetailsByTransactionId($transaction_id);

        $data['transaction'] = $transaction;
        $data['details'] = $details;
        $data['title'] = 'Detail Transaksi';

        return view('riwayat/detail', $data);
    }
}
