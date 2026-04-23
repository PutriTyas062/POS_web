<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransactionsTable extends Migration
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
            'transaction_code' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'unique' => true,
            ],
            'tanggal_jam' => [
                'type' => 'DATETIME',
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'total_item' => [
                'type' => 'INT',
            ],
            'subtotal' => [
                'type' => 'INT',
            ],
            'discount_type' => [
                'type' => 'ENUM',
                'constraint' => ['Tunas', 'QRIS', 'Debit'],
                'default' => 'Tunas',
            ],
            'discount_value' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'ppn_percent' => [
                'type' => 'DECIMAL',
                'constraint' => [5, 2],
                'default' => 11,
            ],
            'ppn_value' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'total_payment' => [
                'type' => 'INT',
            ],
            'cash_received' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'cash_return' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['Tunai', 'QRIS', 'Debit'],
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
