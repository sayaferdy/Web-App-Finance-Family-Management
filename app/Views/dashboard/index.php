<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="dashboard-header">

    <div>
        <h3 class="fw-bold mb-1">
            Dashboard Keuangan
        </h3>

        <p class="text-muted mb-0">
            Ringkasan kondisi keuangan keluarga
        </p>
    </div>

</div>

<!-- =========================================
SUMMARY CARDS
========================================= -->

<div class="row g-4 mb-4">

    <!-- SHARED INCOME -->
    <div class="col-lg-4 col-md-6">

        <div class="finance-card income-card">

            <div class="finance-icon bg-success-subtle text-success">
                <i class="bi bi-arrow-down-circle"></i>
            </div>

            <div>
                <small>Total Pemasukan Rumah</small>

                <h3>
                    Rp <?= number_format($sharedIncome,0,',','.') ?>
                </h3>
            </div>

        </div>

    </div>

    <!-- SHARED EXPENSE -->
    <div class="col-lg-4 col-md-6">

        <div class="finance-card expense-card">

            <div class="finance-icon bg-danger-subtle text-danger">
                <i class="bi bi-arrow-up-circle"></i>
            </div>

            <div>
                <small>Total Pengeluaran Rumah</small>

                <h3>
                    Rp <?= number_format($sharedExpense,0,',','.') ?>
                </h3>
            </div>

        </div>

    </div>

    <!-- SHARED BALANCE -->
    <div class="col-lg-4 col-md-12">

        <div class="finance-card balance-card">

            <div class="finance-icon bg-primary-subtle text-primary">
                <i class="bi bi-wallet2"></i>
            </div>

            <div>

                <small>Saldo Rumah</small>

                <h3>
                    Rp <?= number_format($sharedBalance,0,',','.') ?>
                </h3>

                <?php if($sharedBalance >= 0): ?>

                    <span class="status-positive">
                        Surplus
                    </span>

                <?php else: ?>

                    <span class="status-negative">
                        Defisit
                    </span>

                <?php endif; ?>

            </div>

        </div>

    </div>

</div>

<!-- =========================================
PERSONAL
========================================= -->

<div class="row g-4 mb-4">

    <div class="col-lg-4 col-md-6">

        <div class="finance-card">

            <div class="finance-icon bg-info-subtle text-info">
                <i class="bi bi-person-circle"></i>
            </div>

            <div>
                <small>Pemasukan Pribadi</small>

                <h3>
                    Rp <?= number_format($personalIncome,0,',','.') ?>
                </h3>
            </div>

        </div>

    </div>

    <div class="col-lg-4 col-md-6">

        <div class="finance-card">

            <div class="finance-icon bg-warning-subtle text-warning">
                <i class="bi bi-credit-card"></i>
            </div>

            <div>
                <small>Pengeluaran Pribadi</small>

                <h3>
                    Rp <?= number_format($personalExpense,0,',','.') ?>
                </h3>
            </div>

        </div>

    </div>

    <div class="col-lg-4 col-md-12">

        <div class="finance-card">

            <div class="finance-icon bg-secondary-subtle text-secondary">
                <i class="bi bi-piggy-bank"></i>
            </div>

            <div>

                <small>Saldo Pribadi</small>

                <h3>
                    Rp <?= number_format($personalBalance,0,',','.') ?>
                </h3>

            </div>

        </div>

    </div>

</div>

<!-- =========================================
CHARTS
========================================= -->

<div class="row g-4 mb-4">

    <div class="col-lg-8">

        <div class="card dashboard-card">

            <div class="card-body">

                <div class="section-title">
                    Statistik Keuangan
                </div>

                <canvas id="barChart"></canvas>

            </div>

        </div>

    </div>

    <div class="col-lg-4">

        <div class="card dashboard-card">

            <div class="card-body">

                <div class="section-title">
                    Pemasukan vs Pengeluaran
                </div>

                <canvas id="pieChart"></canvas>

            </div>

        </div>

    </div>

</div>

<!-- =========================================
RECENT TRANSACTION
========================================= -->

<div class="card dashboard-card">

    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h5 class="mb-1">
                    Transaksi Terbaru
                </h5>

                <small class="text-muted">
                    Aktivitas transaksi terbaru
                </small>

            </div>

            <a href="/transactions"
               class="btn btn-primary">

                View All

            </a>

        </div>

        <div class="table-responsive">

            <table class="table modern-table">

                <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th>User</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Nominal</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach(array_slice($shared,0,5) as $trx): ?>

                    <tr>

                        <td>
                            <?= date('d M Y', strtotime($trx['transaction_date'])) ?>
                        </td>

                        <td>
                            <?= esc($trx['user_name']) ?>
                        </td>

                        <td>
                            <?= esc($trx['category_name']) ?>
                        </td>

                        <td>

                            <?php if($trx['type'] == 'income'): ?>

                                <span class="badge bg-success">
                                    Pemasukan
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    pengeluaran
                                </span>

                            <?php endif; ?>

                        </td>

                        <td class="fw-semibold">
                            Rp <?= number_format($trx['amount'],0,',','.') ?>
                        </td>

                    </tr>

                <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const sharedIncome = <?= $sharedIncome ?>;
const sharedExpense = <?= $sharedExpense ?>;
const personalIncome = <?= $personalIncome ?>;
const personalExpense = <?= $personalExpense ?>;

new Chart(document.getElementById('barChart'), {

    type: 'bar',

    data: {

        labels: [
            'Shared Income',
            'Shared Expense',
            'Personal Income',
            'Personal Expense'
        ],

        datasets: [{

            data: [
                sharedIncome,
                sharedExpense,
                personalIncome,
                personalExpense
            ],

            borderRadius: 10,

            backgroundColor: [
                '#22c55e',
                '#ef4444',
                '#3b82f6',
                '#f59e0b'
            ]

        }]

    },

    options: {

        plugins:{
            legend:{
                display:false
            }
        },

        responsive:true

    }

});

new Chart(document.getElementById('pieChart'), {

    type:'doughnut',

    data: {

        labels:['Income','Expense'],

        datasets:[{

            data:[
                sharedIncome + personalIncome,
                sharedExpense + personalExpense
            ],

            backgroundColor:[
                '#22c55e',
                '#ef4444'
            ],

            borderWidth:0

        }]

    },

    options:{
        responsive:true
    }

});

</script>

<?= $this->endSection() ?>