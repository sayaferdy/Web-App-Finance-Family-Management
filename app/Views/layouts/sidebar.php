<?php
$role = strtoupper(session()->get('role') ?? 'MEMBER');

$segment = service('uri')->getSegment(1);
?>

<div class="sidebar" id="sidebar">

    <!-- =========================================
    BRAND
    ========================================== -->
    <div class="sidebar-brand">

        <div class="brand-icon">
            <i class="bi bi-wallet2"></i>
        </div>

        <div>

            <h5 class="mb-0">
                Rumahku
            </h5>

            <small>
                Finance App
            </small>

        </div>

    </div>

    <!-- =========================================
    MENU
    ========================================== -->
    <div class="sidebar-menu">

        <!-- DASHBOARD -->
        <a href="/dashboard"
           class="sidebar-link <?= $segment == 'dashboard' ? 'active' : '' ?>">

            <i class="bi bi-grid"></i>

            <span>
                Dashboard
            </span>

        </a>

        <!-- TRANSACTIONS -->
        <a href="/transactions"
           class="sidebar-link <?= $segment == 'transactions' ? 'active' : '' ?>">

            <i class="bi bi-cash-stack"></i>

            <span>
                Transaksi
            </span>

        </a>

        <!-- REPORTS -->
        <a href="/reports/monthly"
           class="sidebar-link <?= $segment == 'reports' ? 'active' : '' ?>">

            <i class="bi bi-bar-chart"></i>

            <span>
                Laporan Keuangan
            </span>

        </a>

        <!-- BUDGETS -->
        <a href="/budgets"
           class="sidebar-link <?= $segment == 'budgets' ? 'active' : '' ?>">

            <i class="bi bi-piggy-bank"></i>

            <span>
                Budgets
            </span>

        </a>

        <!-- BILLS -->
        <a href="/bills"
           class="sidebar-link <?= $segment == 'bills' ? 'active' : '' ?>">

            <i class="bi bi-receipt"></i>

            <span>
                Tagihan
            </span>

        </a>

        <!-- USER MANAGEMENT -->
        <?php if ($role === 'SUPERADMIN'): ?>

            <a href="/users"
               class="sidebar-link <?= $segment == 'users' ? 'active' : '' ?>">

                <i class="bi bi-people"></i>

                <span>
                    Manajemen Pengguna
                </span>

            </a>

        <?php endif; ?>

    </div>

    <!-- =========================================
    FOOTER
    ========================================== -->
    <div class="sidebar-footer">

        <div class="role-box">

            <small class="role-label">
                Logged as
            </small>

            <div class="role-badge">

                <?= $role ?>

            </div>

        </div>

    </div>

</div>