<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Kasir extends BaseController
{
    protected $productModel;
    protected $transactionModel;
    protected $transactionDetailModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->transactionModel = new TransactionModel();
        $this->transactionDetailModel = new TransactionDetailModel();
    }

    public function index()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/auth');
        }

        $data['products'] = $this->productModel->getActiveProducts();
        $data['title'] = 'Kasir';

        return view('kasir/pos', $data);
    }

    public function addItem()
    {
        $product_id = $this->request->getPost('product_id');
        $quantity = $this->request->getPost('quantity') ?? 1;

        $product = $this->productModel->find($product_id);

        if ($product) {
            $cart = session()->get('cart') ?? [];
            
            if (isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] += $quantity;
            } else {
                $cart[$product_id] = [
                    'id' => $product['id'],
                    'product_name' => $product['product_name'],
                    'selling_price' => $product['selling_price'],
                    'quantity' => $quantity,
                ];
            }

            session()->set('cart', $cart);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function removeItem()
    {
        $product_id = $this->request->getPost('product_id');
        $cart = session()->get('cart') ?? [];

        if (isset($cart[$product_id])) {
            unset($cart[$product_id]);
            session()->set('cart', $cart);
        }

        return $this->response->setJSON(['status' => 'success']);
    }

    public function getCart()
    {
        $cart = session()->get('cart') ?? [];
        $total_items = 0;
        $subtotal = 0;

        foreach ($cart as $item) {
            $total_items += $item['quantity'];
            $subtotal += $item['selling_price'] * $item['quantity'];
        }

        return $this->response->setJSON([
            'cart' => $cart,
            'total_items' => $total_items,
            'subtotal' => $subtotal,
        ]);
    }

    public function checkout()
    {
        $cartPayload = $this->request->getPost('cart');
        $cart = [];

        if (!empty($cartPayload)) {
            $decodedCart = json_decode($cartPayload, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decodedCart)) {
                $cart = $decodedCart;
            }
        }

        if (empty($cart)) {
            $cart = session()->get('cart') ?? [];
        }

        if (empty($cart)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Keranjang kosong']);
        }

        $total_items = 0;
        $subtotal = 0;

        foreach ($cart as $item) {
            $total_items += $item['quantity'];
            $subtotal += $item['selling_price'] * $item['quantity'];
        }

        $ppn_percent = 11;
        $ppn_value = floor($subtotal * $ppn_percent / 100);
        $total_payment = $subtotal + $ppn_value;

        $transaction_code = $this->transactionModel->generateTransactionCode();
        $user_id = session()->get('user_id');
        $payment_status = $this->request->getPost('payment_status') ?? 'Tunai';

        $discount_value = $this->request->getPost('discount') ?? 0;
        $cash_received = $this->request->getPost('cash_received') ?? 0;

        if ($payment_status === 'Tunai' && $cash_received > 0) {
            $cash_return = $cash_received - $total_payment;
        } else {
            $cash_return = 0;
        }

        $transactionData = [
            'transaction_code' => $transaction_code,
            'tanggal_jam' => date('Y-m-d H:i:s'),
            'user_id' => $user_id,
            'total_item' => $total_items,
            'subtotal' => $subtotal,
            'discount_value' => $discount_value,
            'ppn_percent' => $ppn_percent,
            'ppn_value' => $ppn_value,
            'total_payment' => $total_payment,
            'cash_received' => $cash_received,
            'cash_return' => $cash_return,
            'payment_status' => $payment_status,
        ];

        $transaction_id = $this->transactionModel->insert($transactionData);

        if (!$transaction_id) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Transaksi gagal disimpan']);
        }

        // Save transaction details
        foreach ($cart as $item) {
            $detailData = [
                'transaction_id' => $transaction_id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['selling_price'],
                'subtotal' => $item['selling_price'] * $item['quantity'],
            ];
            $this->transactionDetailModel->insert($detailData);

            // Decrease product stock
            $this->productModel->decreaseStock($item['id'], $item['quantity']);
        }

        // Clear cart
        session()->remove('cart');

        return $this->response->setJSON([
            'status' => 'success',
            'transaction_id' => $transaction_id,
            'transaction_code' => $transaction_code,
            'total_payment' => $total_payment,
            'subtotal' => $subtotal,
            'ppn_value' => $ppn_value,
            'cash_received' => $cash_received,
            'cash_return' => $cash_return,
        ]);
    }

    public function getCategories()
    {
        $categories = ['Makanan', 'Minuman', 'Lainnya'];
        return $this->response->setJSON($categories);
    }

    public function getProductsByCategory()
    {
        $category = $this->request->getGet('category');
        $products = $this->productModel->getProductsByCategory($category);
        return $this->response->setJSON($products);
    }
}
