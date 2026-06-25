-- POS System Database Setup Script
-- Import this file into phpMyAdmin to recreate the database from scratch.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

DROP DATABASE IF EXISTS pos_system;
CREATE DATABASE pos_system CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE pos_system;

-- =====================
-- TABLE: users
-- =====================
CREATE TABLE users (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    full_name VARCHAR(150) NOT NULL,
    role ENUM('admin', 'kasir') NOT NULL DEFAULT 'kasir',
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY (id),
    UNIQUE KEY users_username_unique (username),
    UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: products
-- =====================
CREATE TABLE products (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    product_code VARCHAR(50) NOT NULL,
    product_name VARCHAR(150) NOT NULL,
    category ENUM('Makanan', 'Minuman', 'Lainnya') NOT NULL,
    unit ENUM('Buah', 'Cup', 'Pcs', 'Dus', 'Botol') NOT NULL DEFAULT 'Pcs',
    purchase_price INT(11) NOT NULL,
    selling_price INT(11) NOT NULL,
    stock INT(11) NOT NULL DEFAULT 0,
    min_stock INT(11) NOT NULL DEFAULT 5,
    image VARCHAR(255) NULL,
    status ENUM('AKTIF', 'NONAKTIF') NOT NULL DEFAULT 'AKTIF',
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY (id),
    UNIQUE KEY products_product_code_unique (product_code),
    KEY products_category_index (category),
    KEY products_status_index (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: transactions
-- =====================
CREATE TABLE transactions (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    transaction_code VARCHAR(50) NOT NULL,
    tanggal_jam DATETIME NOT NULL,
    user_id INT(11) UNSIGNED NOT NULL,
    total_item INT(11) NOT NULL,
    subtotal INT(11) NOT NULL,
    discount_type ENUM('Tunas', 'QRIS', 'Debit') NOT NULL DEFAULT 'Tunas',
    discount_value INT(11) NOT NULL DEFAULT 0,
    ppn_percent DECIMAL(5,2) NOT NULL DEFAULT 11.00,
    ppn_value INT(11) NOT NULL DEFAULT 0,
    total_payment INT(11) NOT NULL,
    cash_received INT(11) NOT NULL DEFAULT 0,
    cash_return INT(11) NOT NULL DEFAULT 0,
    payment_status ENUM('Tunai', 'QRIS', 'Debit') NOT NULL,
    notes TEXT NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY (id),
    UNIQUE KEY transactions_transaction_code_unique (transaction_code),
    KEY transactions_tanggal_jam_index (tanggal_jam),
    KEY transactions_user_id_index (user_id),
    CONSTRAINT transactions_user_id_foreign
        FOREIGN KEY (user_id) REFERENCES users (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: transaction_details
-- =====================
CREATE TABLE transaction_details (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    transaction_id INT(11) UNSIGNED NOT NULL,
    product_id INT(11) UNSIGNED NOT NULL,
    quantity INT(11) NOT NULL,
    unit_price INT(11) NOT NULL,
    subtotal INT(11) NOT NULL,
    created_at DATETIME NULL,
    PRIMARY KEY (id),
    KEY transaction_details_transaction_id_index (transaction_id),
    KEY transaction_details_product_id_index (product_id),
    CONSTRAINT transaction_details_transaction_id_foreign
        FOREIGN KEY (transaction_id) REFERENCES transactions (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT transaction_details_product_id_foreign
        FOREIGN KEY (product_id) REFERENCES products (id)
        ON UPDATE CASCADE
        ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: expenses
-- =====================
CREATE TABLE expenses (
    id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    tanggal DATETIME NOT NULL,
    category ENUM('Listrik', 'Gas', 'Pembaharuan', 'Sewa', 'Lainnya') NOT NULL,
    deskripsi TEXT NULL,
    nominal INT(11) NOT NULL,
    pengguna VARCHAR(150) NOT NULL,
    lampiran VARCHAR(255) NULL,
    created_at DATETIME NULL,
    updated_at DATETIME NULL,
    PRIMARY KEY (id),
    KEY expenses_tanggal_index (tanggal),
    KEY expenses_category_index (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- TABLE: migrations
-- =====================
CREATE TABLE migrations (
    id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
    version BIGINT(20) UNSIGNED NOT NULL,
    class VARCHAR(255) NOT NULL,
    `group` VARCHAR(255) NOT NULL,
    namespace VARCHAR(255) NOT NULL,
    time BIGINT(20) NOT NULL,
    batch INT(11) UNSIGNED NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================
-- SAMPLE DATA
-- =====================
INSERT INTO users (username, email, password, full_name, role, status, created_at, updated_at) VALUES
('admin', 'admin@pos.local', '$2y$10$63B.6qIqntWX5Kr9uuc5zec3XTuCZ4joHztSXoPpt2I7L0umEF59.', 'Administrator', 'admin', 'active', NOW(), NOW()),
('kasir', 'kasir@pos.local', '$2y$10$1Yi2jrxEc6/xaVh17sTRBOICRcqSjp0PCqXBA4QLSVEwz1yETxuA6', 'Kasir 1', 'kasir', 'active', NOW(), NOW());

INSERT INTO products (product_code, product_name, category, unit, purchase_price, selling_price, stock, min_stock, status, created_at, updated_at) VALUES
('PRD-001', 'Pempek', 'Makanan', 'Pcs', 8000, 12000, 50, 5, 'AKTIF', NOW(), NOW()),
('PRD-002', 'Cireng Isi', 'Makanan', 'Pcs', 10000, 18000, 40, 5, 'AKTIF', NOW(), NOW()),
('PRD-003', 'Roti Bakar', 'Makanan', 'Pcs', 8000, 15000, 30, 5, 'AKTIF', NOW(), NOW()),
('PRD-004', 'Curros', 'Makanan', 'Pcs', 10000, 15000, 25, 5, 'AKTIF', NOW(), NOW()),
('PRD-005', 'Es Kopi', 'Minuman', 'Cup', 2500, 5000, 100, 10, 'AKTIF', NOW(), NOW()),
('PRD-006', 'Es Teh Jumbo', 'Minuman', 'Cup', 2000, 3000, 150, 10, 'AKTIF', NOW(), NOW()),
('PRD-007', 'Es Nutrisi', 'Minuman', 'Cup', 4000, 8000, 60, 5, 'AKTIF', NOW(), NOW()),
('PRD-008', 'Air Mineral 600ml', 'Minuman', 'Botol', 3000, 5000, 120, 10, 'AKTIF', NOW(), NOW());

SET FOREIGN_KEY_CHECKS = 1;

-- Login default:
-- Admin: admin / admin123
-- Kasir: kasir / kasir123