<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            max-width: 500px;
            width: 90%;
        }

        .login-header {
            background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
            padding: 40px 20px;
            text-align: center;
            color: white;
        }

        .login-header h1 {
            font-size: 32px;
            margin-bottom: 5px;
        }

        .login-header p {
            opacity: 0.9;
            font-size: 14px;
        }

        .login-form {
            padding: 40px;
        }

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

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #FF8C42;
            box-shadow: 0 0 0 3px rgba(255, 140, 66, 0.1);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            transition: transform 0.2s;
        }

        .btn-login:hover {
            transform: translateY(-2px);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert {
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .demo-info {
            background: #f0f0f0;
            padding: 15px;
            border-radius: 8px;
            font-size: 13px;
            margin-top: 20px;
            color: #666;
        }

        .demo-info strong {
            color: #FF8C42;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h1><i class="fas fa-shopping-cart"></i> POS System</h1>
            <p>Sistem Penjualan Terpadu</p>
        </div>

        <div class="login-form">
            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form method="post" action="/auth/login">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>

            <div class="demo-info">
                <strong>Demo Akun Admin:</strong><br>
                Username: admin<br>
                Password: admin123<br><br>
                <strong>Demo Akun Kasir:</strong><br>
                Username: kasir<br>
                Password: kasir123
            </div>
        </div>
    </div>
</body>
</html>