-- POS System Database Setup Script
-- Run this file in phpMyAdmin or MySQL CLI after creating the database

USE pos_system;

-- =====================
-- TABLE: users
-- =====================
CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    role ENUM('admin', 'kasir') DEFAULT 'kasir',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at DATETIME,
    updated_at DATETIME,
    INDEX idx_username (username),
    INDEX idx_role (role)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: products
-- =====================
CREATE TABLE IF NOT EXISTS products (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    product_code VARCHAR(50) NOT NULL UNIQUE,
    product_name VARCHAR(150) NOT NULL,
    category ENUM('Makanan', 'Minuman', 'Lainnya'),
    unit ENUM('Buah', 'Cup', 'Pcs', 'Dus', 'Botol') DEFAULT 'Pcs',
    purchase_price INT,
    selling_price INT,
    stock INT DEFAULT 0,
    min_stock INT DEFAULT 5,
    image VARCHAR(255),
    status ENUM('AKTIF', 'NONAKTIF') DEFAULT 'AKTIF',
    created_at DATETIME,
    updated_at DATETIME,
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_product_code (product_code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: transactions
-- =====================
CREATE TABLE IF NOT EXISTS transactions (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaction_code VARCHAR(50) NOT NULL UNIQUE,
    tanggal_jam DATETIME NOT NULL,
    user_id INT UNSIGNED NOT NULL,
    total_item INT,
    subtotal INT,
    discount_type ENUM('Tunas', 'QRIS', 'Debit') DEFAULT 'Tunas',
    discount_value INT DEFAULT 0,
    ppn_percent DECIMAL(5, 2) DEFAULT 11,
    ppn_value INT DEFAULT 0,
    total_payment INT,
    cash_received INT DEFAULT 0,
    cash_return INT DEFAULT 0,
    payment_status ENUM('Tunai', 'QRIS', 'Debit'),
    notes TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_transaction_code (transaction_code),
    INDEX idx_tanggal_jam (tanggal_jam),
    INDEX idx_user_id (user_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: transaction_details
-- =====================
CREATE TABLE IF NOT EXISTS transaction_details (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    transaction_id INT UNSIGNED NOT NULL,
    product_id INT UNSIGNED NOT NULL,
    quantity INT,
    unit_price INT,
    subtotal INT,
    created_at DATETIME,
    FOREIGN KEY (transaction_id) REFERENCES transactions(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_transaction_id (transaction_id),
    INDEX idx_product_id (product_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: expenses
-- =====================
CREATE TABLE IF NOT EXISTS expenses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tanggal DATETIME NOT NULL,
    category ENUM('Listrik', 'Gas', 'Pembaharuan', 'Sewa', 'Lainnya'),
    deskripsi TEXT,
    nominal INT,
    pengguna VARCHAR(150),
    lampiran VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    INDEX idx_tanggal (tanggal),
    INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- MIGRATION TRACKING TABLE (untuk CodeIgniter)
-- =====================
CREATE TABLE IF NOT EXISTS migrations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    version BIGINT UNSIGNED NOT NULL,
    class VARCHAR(255) NOT NULL,
    group VARCHAR(255) NOT NULL,
    namespace VARCHAR(255) NOT NULL,
    time BIGINT NOT NULL,
    batch INT UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- INSERT INITIAL DATA (Sample Users & Products)
-- =====================

-- Insert Admin User
INSERT INTO users (username, email, password, full_name, role, status, created_at, updated_at) 
VALUES ('admin', 'admin@pos.local', '$2y$10$rUOVxJU5WdvXdhEKhRNvXOwBH4Zc2cXhjQJ0K3jLlLyYptGxFakpW', 'Administrator', 'admin', 'active', NOW(), NOW());

-- Insert Kasir User (Password: kasir123)
INSERT INTO users (username, email, password, full_name, role, status, created_at, updated_at) 
VALUES ('kasir', 'kasir@pos.local', '$2y$10$nRZNGKk6u4YMI8cLb5J/L.HyN5uIRYIWQ7Lr6n5lLmDvWzF1v8Rne', 'Kasir 1', 'kasir', 'active', NOW(), NOW());

-- Insert Sample Products
INSERT INTO products (product_code, product_name, category, unit, purchase_price, selling_price, stock, min_stock, status, created_at, updated_at) VALUES
('PRD-001', 'Pempek', 'Makanan', 'Pcs', 8000, 12000, 50, 5, 'AKTIF', NOW(), NOW()),
('PRD-002', 'Cireng Isi', 'Makanan', 'Pcs', 10000, 18000, 40, 5, 'AKTIF', NOW(), NOW()),
('PRD-003', 'Roti Bakar', 'Makanan', 'Pcs', 8000, 15000, 30, 5, 'AKTIF', NOW(), NOW()),
('PRD-004', 'Curros', 'Makanan', 'Pcs', 10000, 15000, 25, 5, 'AKTIF', NOW(), NOW()),
('PRD-005', 'Es Kopi', 'Minuman', 'Cup', 2500, 5000, 100, 10, 'AKTIF', NOW(), NOW()),
('PRD-006', 'Es Teh Jumbo', 'Minuman', 'Cup', 2000, 3000, 150, 10, 'AKTIF', NOW(), NOW()),
('PRD-007', 'Es Nutrisi', 'Minuman', 'Cup', 4000, 8000, 60, 5, 'AKTIF', NOW(), NOW()),
('PRD-008', 'Air Mineral 600ml', 'Minuman', 'Botol', 3000, 5000, 120, 10, 'AKTIF', NOW(), NOW());

-- =====================
-- NOTES
-- =====================
-- Admin Password: admin123
-- Kasir Password: kasir123
-- 
-- Passwords are hashed using PHP's password_hash() function with PASSWORD_DEFAULT algorithm
-- To verify: password_verify('plaintext', '$2y$10$...')
