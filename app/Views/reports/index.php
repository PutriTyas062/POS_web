<?= $this->extend('layout'); ?>

<?= $this->section('content'); ?>

<style>
    .nav-tabs {
        display: flex;
        gap: 10px;
        border-bottom: 2px solid #e0e0e0;
        margin-bottom: 30px;
        padding-bottom: 15px;
    }

    .nav-tab {
        padding: 10px 20px;
        background: none;
        border: none;
        cursor: pointer;
        font-weight: 600;
        color: #999;
        border-bottom: 3px solid transparent;
        transition: all 0.3s;
    }

    .nav-tab.active {
        color: #FF8C42;
        border-bottom-color: #FF8C42;
    }

    .nav-tab:hover {
        color: #FF8C42;
    }

    .tab-content {
        display: none;
    }

    .tab-content.active {
        display: block;
    }

    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-left: 5px solid #FF8C42;
    }

    .stat-label {
        font-size: 13px;
        color: #999;
        margin-bottom: 10px;
        text-transform: uppercase;
    }

    .stat-value {
        font-size: 24px;
        font-weight: bold;
        color: #333;
    }

    .chart-container {
        background: white;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    .chart-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    .chart-title {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .filter-bar {
        display: flex;
        gap: 10px;
        align-items: flex-end;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-group label {
        font-size: 13px;
        font-weight: 600;
        color: #333;
    }

    .filter-group input {
        padding: 8px 12px;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        font-size: 13px;
    }

    @media (max-width: 1024px) {
        .chart-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="card">
    <div class="card-header">
        <h2>Laporan</h2>
        <div class="buttons">
            <button class="btn btn-primary" onclick="printReport()"><i class="fas fa-print"></i> Cetak Laporan</button>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="filter-bar">
        <div class="filter-group" style="flex: 1; min-width: 150px;">
            <label>Dari Tanggal</label>
            <input type="date" id="startDate" value="<?= date('Y-m-01'); ?>">
        </div>
        <div class="filter-group" style="flex: 1; min-width: 150px;">
            <label>Sampai Tanggal</label>
            <input type="date" id="endDate" value="<?= date('Y-m-d'); ?>">
        </div>
        <button class="btn btn-primary" onclick="filterReport()"><i class="fas fa-filter"></i> Filter periode</button>
    </div>

    <!-- Tabs Navigation -->
    <div class="nav-tabs">
        <button class="nav-tab active" onclick="switchTab(0)"><i class="fas fa-arrow-up"></i> Pendapatan</button>
        <button class="nav-tab" onclick="switchTab(1)"><i class="fas fa-arrow-down"></i> Pengeluaran</button>
        <button class="nav-tab" onclick="switchTab(2)"><i class="fas fa-chart-bar"></i> Perbandingan</button>
    </div>

    <!-- Tab 1: Pendapatan -->
    <div class="tab-content active" id="tab-0">
        <div class="stat-cards">
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-shopping-bag"></i> Total Transaksi</div>
                <div class="stat-value" id="totalTransactions">0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-money-bill-wave"></i> Total Pendapatan</div>
                <div class="stat-value" id="totalIncome">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-percent"></i> Rata-rata Transaksi</div>
                <div class="stat-value" id="avgTransaction">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-chart-pie"></i> Terbesar Hari Ini</div>
                <div class="stat-value" id="maxTransaction">Rp 0</div>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-title">Pendapatan Harian</div>
            <canvas id="incomeChart" height="80"></canvas>
        </div>

        <div class="chart-grid">
            <div class="chart-container">
                <div class="chart-title">Metode Pembayaran</div>
                <canvas id="paymentMethodChart" height="150"></canvas>
            </div>
            <div class="chart-container">
                <div class="chart-title">Kategori Produk</div>
                <canvas id="categoryChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Tab 2: Pengeluaran -->
    <div class="tab-content" id="tab-1">
        <div class="stat-cards">
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-receipt"></i> Total Pengeluaran</div>
                <div class="stat-value" id="totalExpenses">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-flag"></i> Kategori Terbanyak</div>
                <div class="stat-value" id="topExpenseCategory">-</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-chart-line"></i> Rata-rata Harian</div>
                <div class="stat-value" id="avgExpense">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-exclamation-triangle"></i> Pengeluaran Terbesar</div>
                <div class="stat-value" id="maxExpense">Rp 0</div>
            </div>
        </div>

        <div class="chart-grid">
            <div class="chart-container">
                <div class="chart-title">Pengeluaran Harian</div>
                <canvas id="expenseChart" height="150"></canvas>
            </div>
            <div class="chart-container">
                <div class="chart-title">Pengeluaran per Kategori</div>
                <canvas id="expenseCategoryChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <!-- Tab 3: Perbandingan -->
    <div class="tab-content" id="tab-2">
        <div class="stat-cards">
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-arrow-up"></i> Total Pendapatan</div>
                <div class="stat-value" id="compareIncome">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-arrow-down"></i> Total Pengeluaran</div>
                <div class="stat-value" id="compareExpenses">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-chart-line"></i> Laba Kotor</div>
                <div class="stat-value" id="compareGrossProfit">Rp 0</div>
            </div>
            <div class="stat-card">
                <div class="stat-label"><i class="fas fa-percent"></i> Margin Keuntungan</div>
                <div class="stat-value" id="compareMargin">0%</div>
            </div>
        </div>

        <div class="chart-container">
            <div class="chart-title">Pendapatan vs Pengeluaran Harian</div>
            <canvas id="comparisonChart" height="80"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let charts = {};

    function switchTab(tabIndex) {
        // Remove active from all tabs
        document.querySelectorAll('.nav-tab').forEach(tab => tab.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));

        // Add active to selected tab
        document.querySelectorAll('.nav-tab')[tabIndex].classList.add('active');
        document.getElementById('tab-' + tabIndex).classList.add('active');

        // Redraw charts
        setTimeout(() => {
            Object.values(charts).forEach(chart => {
                if (chart) chart.resize();
            });
        }, 100);
    }

    function filterReport() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        loadReportData(startDate, endDate);
    }

    function printReport() {
        window.print();
    }

    function formatCurrency(value) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
    }

    async function loadReportData(startDate, endDate) {
        try {
            const response = await fetch(`/reports/data?start_date=${startDate}&end_date=${endDate}`);
            const data = await response.json();

            // Update stat cards
            document.getElementById('totalTransactions').textContent = data.transactions.length;
            document.getElementById('totalIncome').textContent = formatCurrency(data.total_income);
            document.getElementById('avgTransaction').textContent = formatCurrency(data.avg_transaction);
            document.getElementById('maxTransaction').textContent = formatCurrency(data.max_transaction);

            document.getElementById('totalExpenses').textContent = formatCurrency(data.total_expenses);
            document.getElementById('topExpenseCategory').textContent = data.top_expense_category || '-';
            document.getElementById('avgExpense').textContent = formatCurrency(data.avg_expense);
            document.getElementById('maxExpense').textContent = formatCurrency(data.max_expense);

            document.getElementById('compareIncome').textContent = formatCurrency(data.total_income);
            document.getElementById('compareExpenses').textContent = formatCurrency(data.total_expenses);
            document.getElementById('compareGrossProfit').textContent = formatCurrency(data.gross_profit);
            document.getElementById('compareMargin').textContent = data.profit_margin.toFixed(2) + '%';

            // Draw charts
            drawCharts(data);
        } catch (error) {
            console.error('Error loading report data:', error);
        }
    }

    function drawCharts(data) {
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: { display: true, position: 'bottom' }
            }
        };

        // Income Line Chart
        if (charts.incomeChart) charts.incomeChart.destroy();
        charts.incomeChart = new Chart(document.getElementById('incomeChart'), {
            type: 'line',
            data: {
                labels: data.daily_labels,
                datasets: [{
                    label: 'Pendapatan Harian',
                    data: data.daily_income,
                    borderColor: '#FF8C42',
                    backgroundColor: 'rgba(255, 140, 66, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: '#FF8C42'
                }]
            },
            options: { ...chartOptions, scales: { y: { beginAtZero: true } } }
        });

        // Payment Method Pie Chart
        if (charts.paymentMethodChart) charts.paymentMethodChart.destroy();
        charts.paymentMethodChart = new Chart(document.getElementById('paymentMethodChart'), {
            type: 'doughnut',
            data: {
                labels: ['Tunai', 'QRIS', 'Debit'],
                datasets: [{
                    data: data.payment_methods,
                    backgroundColor: ['#4CAF50', '#FFC107', '#2196F3']
                }]
            },
            options: chartOptions
        });

        // Category Pie Chart
        if (charts.categoryChart) charts.categoryChart.destroy();
        charts.categoryChart = new Chart(document.getElementById('categoryChart'), {
            type: 'doughnut',
            data: {
                labels: data.category_labels,
                datasets: [{
                    data: data.category_data,
                    backgroundColor: ['#FF8C42', '#4CAF50', '#2196F3', '#FFC107']
                }]
            },
            options: chartOptions
        });

        // Expense Line Chart
        if (charts.expenseChart) charts.expenseChart.destroy();
        charts.expenseChart = new Chart(document.getElementById('expenseChart'), {
            type: 'line',
            data: {
                labels: data.daily_labels,
                datasets: [{
                    label: 'Pengeluaran Harian',
                    data: data.daily_expenses,
                    borderColor: '#f44336',
                    backgroundColor: 'rgba(244, 67, 54, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: { ...chartOptions, scales: { y: { beginAtZero: true } } }
        });

        // Expense Category Pie Chart
        if (charts.expenseCategoryChart) charts.expenseCategoryChart.destroy();
        charts.expenseCategoryChart = new Chart(document.getElementById('expenseCategoryChart'), {
            type: 'pie',
            data: {
                labels: data.expense_category_labels,
                datasets: [{
                    data: data.expense_category_data,
                    backgroundColor: ['#FF6B35', '#FF8C42', '#FFA500', '#FFB84D', '#FFC266']
                }]
            },
            options: chartOptions
        });

        // Comparison Bar Chart
        if (charts.comparisonChart) charts.comparisonChart.destroy();
        charts.comparisonChart = new Chart(document.getElementById('comparisonChart'), {
            type: 'bar',
            data: {
                labels: data.daily_labels,
                datasets: [
                    {
                        label: 'Pendapatan',
                        data: data.daily_income,
                        backgroundColor: '#4CAF50'
                    },
                    {
                        label: 'Pengeluaran',
                        data: data.daily_expenses,
                        backgroundColor: '#f44336'
                    }
                ]
            },
            options: { ...chartOptions, scales: { y: { beginAtZero: true } } }
        });
    }

    // Load initial data
    document.addEventListener('DOMContentLoaded', function() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        loadReportData(startDate, endDate);
    });
</script>

<?= $this->endSection(); ?>