<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'product_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'category' => [
                'type' => 'ENUM',
                'constraint' => ['Makanan', 'Minuman', 'Lainnya'],
            ],
            'unit' => [
                'type' => 'ENUM',
                'constraint' => ['Buah', 'Cup', 'Pcs', 'Dus', 'Botol'],
                'default' => 'Pcs',
            ],
            'purchase_price' => [
                'type' => 'INT',
            ],
            'selling_price' => [
                'type' => 'INT',
            ],
            'stock' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'min_stock' => [
                'type' => 'INT',
                'default' => 5,
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['AKTIF', 'NONAKTIF'],
                'default' => 'AKTIF',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', false, true);
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
