<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\ExpenseModel;
use App\Models\ProductModel;

class Home extends BaseController
{
    protected $transactionModel;
    protected $expenseModel;
    protected $productModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->expenseModel = new ExpenseModel();
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth');
        }

        $data['summary'] = $this->transactionModel->getSummaryToday();
        $data['total_expense'] = $this->expenseModel->getTotalExpensesToday();
        $data['low_stock'] = $this->productModel->getLowStockProducts();

        return view('dashboard', $data);
    }
}
