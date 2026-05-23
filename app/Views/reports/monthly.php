<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Laporan Bulanan
            </h1>

            <p class="page-subtitle">
                Ringkasan pemasukan & pengeluaran bulanan
            </p>

        </div>

    </div>

    <div class="modern-card mb-4">

        <form method="get">

            <div class="row align-items-end">

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Bulan
                    </label>

                    <select name="month"
                            class="form-select modern-input">

                        <?php for($m=1; $m<=12; $m++): ?>

                            <option value="<?= $m ?>"
                                <?= $m == $month ? 'selected' : '' ?>>

                                <?= date('F', mktime(0,0,0,$m,1)) ?>

                            </option>

                        <?php endfor; ?>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Tahun
                    </label>

                    <select name="year"
                            class="form-select modern-input">

                        <?php for($y=date('Y')-3; $y<=date('Y'); $y++): ?>

                            <option value="<?= $y ?>"
                                <?= $y == $year ? 'selected' : '' ?>>

                                <?= $y ?>

                            </option>

                        <?php endfor; ?>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <button class="btn btn-primary modern-btn w-100">

                        <i class="bi bi-funnel me-1"></i>

                        Sortir Laporan

                    </button>

                </div>

            </div>

        </form>

    </div>

    <div class="row">

        <div class="col-md-4 mb-4">

            <div class="summary-card income-card">

                <div class="summary-icon">

                    <i class="bi bi-arrow-down-circle"></i>

                </div>

                <div>

                    <small>Total Pemasukan</small>

                    <h3>
                        Rp <?= number_format($income,0,',','.') ?>
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="summary-card expense-card">

                <div class="summary-icon">

                    <i class="bi bi-arrow-up-circle"></i>

                </div>

                <div>

                    <small>Total Pengeluaran</small>

                    <h3>
                        Rp <?= number_format($expense,0,',','.') ?>
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="summary-card balance-card">

                <div class="summary-icon">

                    <i class="bi bi-wallet2"></i>

                </div>

                <div>

                    <small>Balance</small>

                    <h3>
                        Rp <?= number_format($balance,0,',','.') ?>
                    </h3>

                    <?php if($balance >= 0): ?>

                        <span class="badge bg-success">
                            Surplus
                        </span>

                    <?php else: ?>

                        <span class="badge bg-danger">
                            Defisit
                        </span>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>