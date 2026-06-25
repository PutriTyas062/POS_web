<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<style>
    .kasir-container {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 20px;
        height: calc(100vh - 200px);
    }

    .products-section {
        display: flex;
        flex-direction: column;
    }

    .search-bar {
        margin-bottom: 20px;
    }

    .search-bar input {
        width: 100%;
        padding: 12px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
    }

    .categories {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        overflow-x: auto;
        padding-bottom: 10px;
    }

    .category-btn {
        padding: 8px 20px;
        background: #f0f0f0;
        border: 2px solid transparent;
        border-radius: 20px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .category-btn.active {
        background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
        color: white;
        border-color: #FF8C42;
    }

    .category-btn:hover {
        border-color: #FF8C42;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 15px;
        overflow-y: auto;
        flex: 1;
    }

    .product-card {
        background: white;
        border: 2px solid #e0e0e0;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        position: relative;
    }

    .product-card:hover {
        border-color: #FF8C42;
        box-shadow: 0 5px 15px rgba(255, 107, 53, 0.2);
        transform: translateY(-5px);
    }

    .product-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        background: #FF8C42;
        color: white;
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 600;
    }

    .product-icon {
        font-size: 40px;
        margin-bottom: 10px;
    }

    .product-name {
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 5px;
        color: #333;
    }

    .product-price {
        font-size: 16px;
        color: #FF8C42;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .product-stock {
        font-size: 11px;
        color: #999;
        margin-bottom: 10px;
    }

    .btn-add {
        width: 100%;
        padding: 8px;
        background: #FF8C42;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-add:hover {
        background: #FF6B35;
    }

    .cart-section {
        background: white;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 20px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .cart-header {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 15px;
        text-align: center;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }

    .cart-items {
        flex: 1;
        overflow-y: auto;
        margin-bottom: 15px;
    }

    .cart-item {
        background: #f9f9f9;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        font-size: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
    }

    .cart-item-name {
        flex: 1;
        font-weight: 600;
    }

    .cart-item-qty {
        background: white;
        padding: 4px 8px;
        border-radius: 3px;
        min-width: 40px;
        text-align: center;
    }

    .cart-item-remove {
        background: #f44336;
        color: white;
        border: none;
        padding: 4px 8px;
        border-radius: 3px;
        cursor: pointer;
        font-size: 11px;
    }

    .cart-total {
        background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
        color: white;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .cart-total-label {
        font-size: 12px;
        opacity: 0.9;
        margin-bottom: 5px;
    }

    .cart-total-value {
        font-size: 24px;
        font-weight: bold;
    }

    .btn-checkout {
        width: 100%;
        padding: 12px;
        background: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.3s;
    }

    .btn-checkout:hover {
        background: #45a049;
    }

    .btn-checkout:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    .empty-cart {
        text-align: center;
        color: #999;
        padding: 40px 20px;
        font-size: 14px;
    }

    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }

    .modal.active {
        display: flex;
    }

    .modal-content {
        background: white;
        padding: 30px;
        border-radius: 10px;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .modal-header {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 24px;
        cursor: pointer;
        color: #999;
    }

    .modal-close:hover {
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #333;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        padding: 10px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
    }

    .modal-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 20px;
    }

    .modal-buttons button {
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s;
    }

    .modal-buttons .btn-cancel {
        background: #e0e0e0;
        color: #333;
    }

    .modal-buttons .btn-submit {
        background: linear-gradient(135deg, #FF8C42 0%, #FF6B35 100%);
        color: white;
    }

    @media (max-width: 768px) {
        .kasir-container {
            grid-template-columns: 1fr;
            height: auto;
        }

        .cart-section {
            height: 300px;
        }

        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        }
    }
</style>

<div class="kasir-container">
    <!-- Products Section -->
    <div class="products-section">
        <div class="search-bar">
            <input type="text" id="searchInput" placeholder="Cari produk...">
        </div>

        <div class="categories">
            <button class="category-btn active" data-category="all">Semua produk</button>
            <button class="category-btn" data-category="Makanan">Makanan</button>
            <button class="category-btn" data-category="Minuman">Minuman</button>
            <button class="category-btn" data-category="Lainnya">Lainnya</button>
        </div>

        <div class="products-grid" id="productsGrid">
            <?php foreach ($products as $product): ?>
                <div class="product-card" onclick="addToCart(<?= $product['id']; ?>, '<?= $product['product_name']; ?>', <?= $product['selling_price']; ?>)">
                    <div class="product-badge"><?= $product['unit']; ?></div>
                    <div class="product-icon"><i class="fas fa-image"></i></div>
                    <div class="product-name"><?= $product['product_name']; ?></div>
                    <div class="product-price">Rp <?= number_format($product['selling_price'], 0, '.', '.'); ?></div>
                    <div class="product-stock">Stok: <?= $product['stock']; ?></div>
                    <button class="btn-add"><i class="fas fa-plus"></i> Tambah</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Cart Section -->
    <div class="cart-section">
        <div class="cart-header">Ringkasan Pembayaran</div>
        <div class="cart-items" id="cartItems">
            <div class="empty-cart">
                <i style="font-size: 32px; display: block; margin-bottom: 10px;" class="fas fa-shopping-cart"></i>
                Keranjang kosong
            </div>
        </div>
        <div class="cart-total">
            <div class="cart-total-label">Total Pembayaran:</div>
            <div class="cart-total-value" id="totalAmount">Rp 0</div>
        </div>
        <button class="btn-checkout" id="checkoutBtn" onclick="openCheckoutModal()" disabled>
            <i class="fas fa-money-bill-wave"></i> Bayar
        </button>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal" id="checkoutModal">
    <div class="modal-content">
        <div class="modal-header">
            <span>Pembayaran</span>
            <button class="modal-close" onclick="closeCheckoutModal()">×</button>
        </div>

        <form id="checkoutForm">
            <div class="form-group">
                <label>Total yang Harus Dibayar:</label>
                <input type="text" id="totalToPay" readonly style="background: #f5f5f5;">
            </div>

            <div class="form-group">
                <label>Metode Pembayaran:</label>
                <select id="paymentMethod" name="payment_status">
                    <option value="Tunai">Tunai</option>
                    <option value="QRIS">QRIS</option>
                    <option value="Debit">Debit</option>
                </select>
            </div>

            <div class="form-group" id="cashReceivedGroup">
                <label>Jumlah Uang Diterima:</label>
                <input type="number" id="cashReceived" name="cash_received" placeholder="Masukkan jumlah uang">
            </div>

            <div class="form-group" id="changeGroup" style="display: none;">
                <label>Kembalian:</label>
                <input type="text" id="change" readonly style="background: #f5f5f5;">
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn-cancel" onclick="closeCheckoutModal()">Batal</button>
                <button type="submit" class="btn-submit">Simpan & Cetak Resi</button>
            </div>
        </form>
    </div>
</div>

<script>
    let cartData = {};

    function addToCart(productId, productName, price) {
        if (cartData[productId]) {
            cartData[productId].quantity += 1;
        } else {
            cartData[productId] = {
                id: productId,
                product_name: productName,
                selling_price: price,
                quantity: 1
            };
        }
        updateCart();
    }

    function removeFromCart(productId) {
        delete cartData[productId];
        updateCart();
    }

    function updateQuantity(productId, quantity) {
        if (quantity <= 0) {
            removeFromCart(productId);
        } else {
            cartData[productId].quantity = quantity;
            updateCart();
        }
    }

    function updateCart() {
        const cartItems = document.getElementById('cartItems');
        let totalItems = 0;
        let subtotal = 0;

        if (Object.keys(cartData).length === 0) {
            cartItems.innerHTML = '<div class="empty-cart"><i style="font-size: 32px; display: block; margin-bottom: 10px;" class="fas fa-shopping-cart"></i>Keranjang kosong</div>';
            document.getElementById('totalAmount').textContent = 'Rp 0';
            document.getElementById('checkoutBtn').disabled = true;
            document.getElementById('totalToPay').value = 'Rp 0';
        } else {
            let html = '';
            for (const id in cartData) {
                const item = cartData[id];
                const itemTotal = item.selling_price * item.quantity;
                totalItems += item.quantity;
                subtotal += itemTotal;

                html += `
                    <div class="cart-item">
                        <div class="cart-item-name">${item.product_name}</div>
                        <div class="cart-item-qty">
                            <input type="number" value="${item.quantity}" min="1" style="width: 40px; text-align: center; border: none;" onchange="updateQuantity(${id}, this.value)">
                        </div>
                        <div style="text-align: right; min-width: 60px; font-size: 11px;">
                            Rp ${new Intl.NumberFormat('id-ID').format(itemTotal)}
                        </div>
                        <button class="cart-item-remove" onclick="removeFromCart(${id})"><i class="fas fa-trash"></i></button>
                    </div>
                `;
            }
            cartItems.innerHTML = html;
            document.getElementById('totalAmount').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
            document.getElementById('checkoutBtn').disabled = false;
            document.getElementById('totalToPay').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
        }
    }

    function openCheckoutModal() {
        if (Object.keys(cartData).length === 0) {
            alert('Keranjang masih kosong');
            return;
        }
        document.getElementById('checkoutModal').classList.add('active');
    }

    function closeCheckoutModal() {
        document.getElementById('checkoutModal').classList.remove('active');
        document.getElementById('cashReceived').value = '';
        document.getElementById('change').value = '';
    }

    document.getElementById('paymentMethod').addEventListener('change', function() {
        const cashGroup = document.getElementById('cashReceivedGroup');
        const changeGroup = document.getElementById('changeGroup');
        if (this.value === 'Tunai') {
            cashGroup.style.display = 'block';
            changeGroup.style.display = 'block';
        } else {
            cashGroup.style.display = 'none';
            changeGroup.style.display = 'none';
        }
    });

    document.getElementById('cashReceived').addEventListener('input', function() {
        const total = parseInt(document.getElementById('totalToPay').value.replace(/[^\d]/g, ''));
        const received = parseInt(this.value) || 0;
        const change = received - total;
        document.getElementById('change').value = 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.max(0, change));
    });

    document.getElementById('checkoutForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        const formData = new FormData();
        formData.append('cart', JSON.stringify(cartData));
        formData.append('payment_status', document.getElementById('paymentMethod').value);
        formData.append('cash_received', document.getElementById('cashReceived').value || 0);

        try {
            const response = await fetch('/kasir/checkout', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.status === 'success') {
                cartData = {};
                updateCart();
                closeCheckoutModal();
                window.location.href = '/riwayat/detail/' + result.transaction_id + '?print=1';
            } else {
                alert(result.message || 'Transaksi gagal disimpan');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan');
        }
    });

    // Category filter
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('.product-card');
        cards.forEach(card => {
            const name = card.querySelector('.product-name').textContent.toLowerCase();
            card.style.display = name.includes(query) ? 'block' : 'none';
        });
    });
</script>

<?= $this->endSection(); ?>