<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'POS System'; ?> - POS System</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container-main {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #FF8C42 0%, #FF6B35 100%);
            color: white;
            padding: 20px 0;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            overflow-y: auto;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }

        .sidebar-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            font-size: 12px;
            opacity: 0.9;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s;
            border-left: 4px solid transparent;
        }

        .sidebar-menu a:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-left-color: white;
        }

        .sidebar-menu a.active {
            background-color: rgba(255, 255, 255, 0.2);
            border-left-color: white;
        }

        .sidebar-menu i {
            width: 25px;
            text-align: center;
            margin-right: 15px;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 2px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-footer a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            margin-top: 5px;
        }

        .sidebar-footer a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 240px;
            display: flex;
            flex-direction: column;
        }

        /* Top Header */
        .top-header {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-header h1 {
            font-size: 24px;
            color: #333;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info .avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .user-info .name {
            display: flex;
            flex-direction: column;
        }

        .user-info .name strong {
            font-size: 14px;
            color: #333;
        }

        .user-info .name span {
            font-size: 12px;
            color: #999;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        /* Cards */
        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header h2 {
            font-size: 20px;
            color: #333;
        }

        .card-header .buttons {
            display: flex;
            gap: 10px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-secondary {
            background: #e0e0e0;
            color: #333;
        }

        .btn-secondary:hover {
            background: #d0d0d0;
        }

        .btn-danger {
            background: #f44336;
            color: white;
        }

        .btn-danger:hover {
            background: #da190b;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 12px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table thead {
            background: #f9f9f9;
        }

        table thead th {
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #e0e0e0;
        }

        table tbody td {
            padding: 12px;
            border-bottom: 1px solid #e0e0e0;
        }

        table tbody tr:hover {
            background: #f9f9f9;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #FF8C42;
            box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.1);
        }

        /* Alert */
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .main-content {
                margin-left: 200px;
            }

            .content-area {
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .container-main {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-footer {
                position: relative;
            }

            table {
                font-size: 12px;
            }

            table thead th,
            table tbody td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container-main">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-shopping-cart"></i></h2>
                <h3>POS System</h3>
                <p>Sistem Penjualan</p>
            </div>

            <ul class="sidebar-menu">
                <?php $current_route = service('router')->controllerName(); ?>
                
                <li>
                    <a href="/" class="<?= $current_route === 'Home' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>

                <?php if (session()->get('role') === 'kasir'): ?>
                    <li>
                        <a href="/kasir" class="<?= $current_route === 'Kasir' ? 'active' : ''; ?>">
                            <i class="fas fa-shopping-cart"></i> Kasir
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat" class="<?= $current_route === 'Riwayat' ? 'active' : ''; ?>">
                            <i class="fas fa-history"></i> Riwayat Transaksi
                        </a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/kasir" class="<?= $current_route === 'Kasir' ? 'active' : ''; ?>">
                            <i class="fas fa-shopping-cart"></i> Kasir
                        </a>
                    </li>
                    <li>
                        <a href="/products" class="<?= $current_route === 'Products' ? 'active' : ''; ?>">
                            <i class="fas fa-box"></i> Barang & Stok
                        </a>
                    </li>
                    <li>
                        <a href="/riwayat" class="<?= $current_route === 'Riwayat' ? 'active' : ''; ?>">
                            <i class="fas fa-history"></i> Riwayat Transaksi
                        </a>
                    </li>
                    <li>
                        <a href="/reports" class="<?= $current_route === 'Reports' ? 'active' : ''; ?>">
                            <i class="fas fa-chart-bar"></i> Laporan
                        </a>
                    </li>
                    <li>
                        <a href="/expenses" class="<?= $current_route === 'Expenses' ? 'active' : ''; ?>">
                            <i class="fas fa-money-bill-wave"></i> Pengeluaran
                        </a>
                    </li>
                    <li>
                        <a href="/users" class="<?= $current_route === 'Users' ? 'active' : ''; ?>">
                            <i class="fas fa-users"></i> Pengaturan
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <div class="sidebar-footer">
                <div style="border-bottom: 2px solid rgba(255, 255, 255, 0.1); padding-bottom: 10px; margin-bottom: 10px;">
                    <p style="font-size: 12px; margin-bottom: 5px;"><strong><?= session()->get('full_name'); ?></strong></p>
                    <p style="font-size: 11px; opacity: 0.8; text-transform: uppercase;"><?= session()->get('role'); ?></p>
                </div>
                <a href="/auth/logout"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <header class="top-header">
                <div>
                    <h1><?= $title ?? 'Dashboard'; ?></h1>
                </div>
                <div class="user-info">
                    <div class="avatar"><?= strtoupper(substr(session()->get('full_name'), 0, 1)); ?></div>
                    <div class="name">
                        <strong><?= session()->get('full_name'); ?></strong>
                        <span><?= ucfirst(session()->get('role')); ?></span>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content'); ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add active class to current page menu
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>