<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExpensesTable extends Migration
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
            'tanggal' => [
                'type' => 'DATETIME',
            ],
            'category' => [
                'type' => 'ENUM',
                'constraint' => ['Listrik', 'Gas', 'Pembaharuan', 'Sewa', 'Lainnya'],
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'nominal' => [
                'type' => 'INT',
            ],
            'pengguna' => [
                'type' => 'VARCHAR',
                'constraint' => 150,
            ],
            'lampiran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('expenses');
    }

    public function down()
    {
        $this->forge->dropTable('expenses');
    }
}
