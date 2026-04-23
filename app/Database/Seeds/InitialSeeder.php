<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class InitialSeeder extends Seeder
{
    public function run()
    {
        // Seed Users
        $userData = [
            [
                'username' => 'admin',
                'email' => 'admin@pos.local',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'full_name' => 'Administrator',
                'role' => 'admin',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'username' => 'kasir',
                'email' => 'kasir@pos.local',
                'password' => password_hash('kasir123', PASSWORD_DEFAULT),
                'full_name' => 'Kasir 1',
                'role' => 'kasir',
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('users')->insertBatch($userData);

        // Seed Products
        $products = [
            ['product_code' => 'PRD-001', 'product_name' => 'Pempek', 'category' => 'Makanan', 'unit' => 'Pcs', 'purchase_price' => 8000, 'selling_price' => 12000, 'stock' => 50, 'min_stock' => 5, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-002', 'product_name' => 'Cireng Isi', 'category' => 'Makanan', 'unit' => 'Pcs', 'purchase_price' => 10000, 'selling_price' => 18000, 'stock' => 40, 'min_stock' => 5, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-003', 'product_name' => 'Roti Bakar', 'category' => 'Makanan', 'unit' => 'Pcs', 'purchase_price' => 8000, 'selling_price' => 15000, 'stock' => 30, 'min_stock' => 5, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-004', 'product_name' => 'Curros', 'category' => 'Makanan', 'unit' => 'Pcs', 'purchase_price' => 10000, 'selling_price' => 15000, 'stock' => 25, 'min_stock' => 5, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-005', 'product_name' => 'Es Kopi', 'category' => 'Minuman', 'unit' => 'Cup', 'purchase_price' => 2500, 'selling_price' => 5000, 'stock' => 100, 'min_stock' => 10, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-006', 'product_name' => 'Es Teh Jumbo', 'category' => 'Minuman', 'unit' => 'Cup', 'purchase_price' => 2000, 'selling_price' => 3000, 'stock' => 150, 'min_stock' => 10, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-007', 'product_name' => 'Es Nutrisi', 'category' => 'Minuman', 'unit' => 'Cup', 'purchase_price' => 4000, 'selling_price' => 8000, 'stock' => 60, 'min_stock' => 5, 'status' => 'AKTIF'],
            ['product_code' => 'PRD-008', 'product_name' => 'Air Mineral 600ml', 'category' => 'Minuman', 'unit' => 'Botol', 'purchase_price' => 3000, 'selling_price' => 5000, 'stock' => 120, 'min_stock' => 10, 'status' => 'AKTIF'],
        ];

        foreach ($products as $product) {
            $product['created_at'] = date('Y-m-d H:i:s');
            $this->db->table('products')->insert($product);
        }

        echo 'Database seeded successfully!';
    }
}
