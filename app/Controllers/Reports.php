<?php

namespace App\Controllers;

use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;
use App\Models\ExpenseModel;

class Reports extends BaseController
{
    protected $transactionModel;
    protected $transactionDetailModel;
    protected $expenseModel;

    public function __construct()
    {
        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
        $this->expenseModel = new ExpenseModel();
    }

    public function index()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['title'] = 'Laporan';
        return view('reports/index', $data);
    }

    public function data()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['error' => 'Unauthorized']);
        }

        $startDate = $this->request->getGet('start_date') ?? date('Y-m-01');
        $endDate = $this->request->getGet('end_date') ?? date('Y-m-d');

        // Get transactions
        $builder = $this->transactionModel->db->table('transactions');
        $builder->where('DATE(tanggal_jam) >=', $startDate);
        $builder->where('DATE(tanggal_jam) <=', $endDate);
        $transactions = $builder->get()->getResultArray();

        // Get expenses
        $expenses = $this->expenseModel->getExpensesByPeriod($startDate, $endDate);

        // Calculate statistics
        $totalIncome = 0;
        $totalItems = 0;
        $maxTransaction = 0;
        $paymentMethods = [0, 0, 0]; // Tunai, QRIS, Debit
        $dailyIncome = [];
        $dailyExpenses = [];
        $categoryData = ['Makanan' => 0, 'Minuman' => 0, 'Lainnya' => 0];

        foreach ($transactions as $trans) {
            $totalIncome += $trans['total_payment'];
            $totalItems += $trans['total_item'];
            $maxTransaction = max($maxTransaction, $trans['total_payment']);

            // Payment methods
            if ($trans['payment_status'] === 'Tunai') $paymentMethods[0]++;
            elseif ($trans['payment_status'] === 'QRIS') $paymentMethods[1]++;
            else $paymentMethods[2]++;

            // Daily income
            $date = date('d M', strtotime($trans['tanggal_jam']));
            $dailyIncome[$date] = ($dailyIncome[$date] ?? 0) + $trans['total_payment'];

            // Get transaction details for categories
            $details = $this->transactionDetailModel->db->table('transaction_details td')
                ->select('p.category, td.subtotal')
                ->join('products p', 'p.id = td.product_id')
                ->where('td.transaction_id', $trans['id'])
                ->get()->getResultArray();

            foreach ($details as $detail) {
                $categoryData[$detail['category']] = ($categoryData[$detail['category']] ?? 0) + $detail['subtotal'];
            }
        }

        // Calculate expense statistics
        $totalExpenses = 0;
        $maxExpense = 0;
        $topExpenseCategory = '';
        $expenseCategoryData = [];

        foreach ($expenses as $exp) {
            $totalExpenses += $exp['nominal'];
            $maxExpense = max($maxExpense, $exp['nominal']);
            
            $expenseCategoryData[$exp['category']] = ($expenseCategoryData[$exp['category']] ?? 0) + $exp['nominal'];
        }

        if (!empty($expenseCategoryData)) {
            $topExpenseCategory = array_key_first($expenseCategoryData);
        }

        // Daily expenses
        foreach ($expenses as $exp) {
            $date = date('d M', strtotime($exp['tanggal']));
            $dailyExpenses[$date] = ($dailyExpenses[$date] ?? 0) + $exp['nominal'];
        }

        // Get all dates in range for chart labels
        $allDates = [];
        $current = strtotime($startDate);
        $end = strtotime($endDate);
        while ($current <= $end) {
            $dateStr = date('d M', $current);
            $allDates[] = $dateStr;
            $dailyIncome[$dateStr] = $dailyIncome[$dateStr] ?? 0;
            $dailyExpenses[$dateStr] = $dailyExpenses[$dateStr] ?? 0;
            $current += 86400;
        }

        // Calculate averages
        $avgTransaction = count($transactions) > 0 ? $totalIncome / count($transactions) : 0;
        $avgExpense = count($expenses) > 0 ? $totalExpenses / count($expenses) : 0;
        $grossProfit = $totalIncome - $totalExpenses;
        $profitMargin = $totalIncome > 0 ? ($grossProfit / $totalIncome) * 100 : 0;

        return $this->response->setJSON([
            'transactions' => $transactions,
            'total_income' => $totalIncome,
            'total_expenses' => $totalExpenses,
            'total_item' => $totalItems,
            'avg_transaction' => $avgTransaction,
            'max_transaction' => $maxTransaction,
            'avg_expense' => $avgExpense,
            'max_expense' => $maxExpense,
            'gross_profit' => $grossProfit,
            'profit_margin' => $profitMargin,
            'top_expense_category' => $topExpenseCategory,
            'payment_methods' => $paymentMethods,
            'daily_income' => array_values($dailyIncome),
            'daily_expenses' => array_values($dailyExpenses),
            'daily_labels' => $allDates,
            'category_labels' => array_keys($categoryData),
            'category_data' => array_values($categoryData),
            'expense_category_labels' => array_keys($expenseCategoryData),
            'expense_category_data' => array_values($expenseCategoryData),
        ]);
    }

    public function sales()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $start_date = $this->request->getGet('start_date') ?? date('Y-m-01');
        $end_date = $this->request->getGet('end_date') ?? date('Y-m-d');

        $builder = $this->transactionModel->db->table('transactions');
        $builder->where('tanggal_jam >=', $start_date . ' 00:00:00');
        $builder->where('tanggal_jam <=', $end_date . ' 23:59:59');
        $builder->orderBy('tanggal_jam', 'DESC');
        $transactions = $builder->get()->getResultArray();

        $total_sales = 0;
        foreach ($transactions as $t) {
            $total_sales += $t['total_payment'];
        }

        $data['transactions'] = $transactions;
        $data['total_sales'] = $total_sales;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['title'] = 'Laporan Penjualan';

        return view('reports/sales', $data);
    }

    public function expenses()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $start_date = $this->request->getGet('start_date') ?? date('Y-m-01');
        $end_date = $this->request->getGet('end_date') ?? date('Y-m-d');

        $expenses = $this->expenseModel->getExpensesByPeriod($start_date, $end_date);

        $total_expenses = 0;
        foreach ($expenses as $e) {
            $total_expenses += $e['nominal'];
        }

        $data['expenses'] = $expenses;
        $data['total_expenses'] = $total_expenses;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        $data['title'] = 'Laporan Pengeluaran';

        return view('reports/expenses', $data);
    }
}
