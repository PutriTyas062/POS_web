<?php

namespace App\Controllers;

use CodeIgniter\Files\File;

class Settings extends BaseController
{
    public function index()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return redirect()->to('/auth');
        }

        $data['title'] = 'Pengaturan';
        $data['settings'] = $this->loadSettings();
        return view('settings/index', $data);
    }

    public function save()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $settings = [];

        // Store profile settings
        $settings['store_name'] = $this->request->getPost('store_name') ?? '';
        $settings['store_email'] = $this->request->getPost('store_email') ?? '';
        $settings['store_address'] = $this->request->getPost('store_address') ?? '';
        $settings['store_phone'] = $this->request->getPost('store_phone') ?? '';
        $settings['store_npwp'] = $this->request->getPost('store_npwp') ?? '';

        // Stock & Tax settings
        $settings['ppn_enabled'] = $this->request->getPost('ppn_enabled') === 'on' ? true : false;
        $settings['ppn_percent'] = (float)($this->request->getPost('ppn_percent') ?? 11);
        $settings['discount_limit'] = (float)($this->request->getPost('discount_limit') ?? 100000);
        $settings['min_stock'] = (int)($this->request->getPost('min_stock') ?? 5);
        $settings['number_format'] = $this->request->getPost('number_format') ?? 'TRX-YYYYMMDD';
        $settings['auto_print'] = $this->request->getPost('auto_print') === 'on' ? true : false;
        $settings['printer_name'] = $this->request->getPost('printer_name') ?? '';

        // Handle logo upload
        $logo = $this->request->getFile('store_logo');
        if ($logo && $logo->isValid() && !$logo->hasMoved()) {
            $newName = $logo->getRandomName();
            $logo->move(WRITEPATH . '../public/uploads/logo/', $newName);
            $settings['store_logo'] = 'uploads/logo/' . $newName;
        }

        // Save settings to file
        $this->saveSettings($settings);

        return $this->response->setJSON(['success' => true, 'message' => 'Pengaturan berhasil disimpan']);
    }

    public function backup()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            $db = db_connect();
            $database = $db->getDatabase();

            // Create backup directory
            $backupDir = WRITEPATH . 'backups/';
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0755, true);
            }

            $backupFile = $backupDir . 'backup_' . date('Y-m-d_H-i-s') . '.sql';

            // Simple backup - export important tables
            $tables = ['users', 'products', 'transactions', 'transaction_details', 'expenses'];
            $sql = '';

            foreach ($tables as $table) {
                $sql .= "-- Table structure for table `$table`\n";
                $sql .= "DROP TABLE IF EXISTS `$table`;\n\n";
                
                $result = $db->query("SHOW CREATE TABLE `$table`");
                $createTable = $result->getRow();
                $sql .= $createTable->{'Create Table'} . ";\n\n";

                // Insert data
                $sql .= "-- Dumping data for table `$table`\n";
                $data = $db->table($table)->get()->getResultArray();
                
                foreach ($data as $row) {
                    $values = array_map(function($v) use ($db) {
                        return is_null($v) ? 'NULL' : "'" . $db->escapeString($v) . "'";
                    }, $row);
                    $sql .= "INSERT INTO `$table` VALUES (" . implode(', ', $values) . ");\n";
                }
                $sql .= "\n";
            }

            file_put_contents($backupFile, $sql);

            return $this->response->setJSON([
                'success' => true, 
                'message' => 'Database berhasil di-backup',
                'file' => 'backup_' . date('Y-m-d_H-i-s') . '.sql'
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function restore()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        try {
            $file = $this->request->getFile('backup_file');
            
            if (!$file || !$file->isValid()) {
                return $this->response->setJSON(['success' => false, 'message' => 'File tidak valid']);
            }

            $sqlContent = file_get_contents($file->getTempName());
            $db = db_connect();

            // Execute SQL statements
            $statements = explode(';', $sqlContent);
            foreach ($statements as $statement) {
                $statement = trim($statement);
                if (!empty($statement)) {
                    $db->query($statement);
                }
            }

            return $this->response->setJSON(['success' => true, 'message' => 'Database berhasil di-restore']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function clear()
    {
        if (!session()->get('user_id') || session()->get('role') !== 'admin') {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $confirmation = $this->request->getPost('confirm');
        if ($confirmation !== 'YES') {
            return $this->response->setJSON(['success' => false, 'message' => 'Konfirmasi tidak sesuai']);
        }

        try {
            $db = db_connect();

            // Clear data but keep admin user
            $db->table('transaction_details')->truncate();
            $db->table('transactions')->truncate();
            $db->table('expenses')->truncate();
            $db->table('products')->truncate();

            return $this->response->setJSON(['success' => true, 'message' => 'Semua data berhasil dihapus']);
        } catch (\Exception $e) {
            return $this->response->setJSON(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    private function loadSettings()
    {
        $settingsFile = WRITEPATH . 'app_settings.json';
        
        if (file_exists($settingsFile)) {
            return json_decode(file_get_contents($settingsFile), true);
        }

        // Default settings
        return [
            'store_name' => 'POS System',
            'store_email' => 'info@pos.test',
            'store_address' => 'Jalan Utama No. 1',
            'store_phone' => '08123456789',
            'store_npwp' => '12345678901234',
            'ppn_enabled' => true,
            'ppn_percent' => 11,
            'discount_limit' => 100000,
            'min_stock' => 5,
            'number_format' => 'TRX-YYYYMMDD',
            'auto_print' => false,
            'printer_name' => '',
            'store_logo' => 'uploads/logo/default.png'
        ];
    }

    private function saveSettings($settings)
    {
        $settingsFile = WRITEPATH . 'app_settings.json';
        file_put_contents($settingsFile, json_encode($settings, JSON_PRETTY_PRINT));
    }
}
