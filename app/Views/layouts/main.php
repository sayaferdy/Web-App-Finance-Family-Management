<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title><?= $title ?? 'Rumahku Finance' ?></title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Font -->
    <link rel="preconnect"
          href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="/assets/css/sidebar.css">
    <link rel="stylesheet" href="/assets/css/topbar.css">
    <link rel="stylesheet" href="/assets/css/table.css">
    <link rel="stylesheet" href="/assets/css/form.css">
    <link rel="stylesheet" href="/assets/css/dashboard.css">

</head>

<body>

<?php
$userName = session()->get('name') ?? 'User';
?>

<!-- MOBILE MENU -->
<button class="mobile-menu-btn d-lg-none"
        id="mobileMenuBtn">

    <i class="bi bi-list"></i>

</button>

<!-- SIDEBAR -->
<?= view('layouts/sidebar') ?>

<!-- MAIN -->
<div class="main-wrapper">

    <!-- TOPBAR -->
    <div class="topbar">

        <div>

            <h5 class="page-title">
                Welcome, <?= esc($userName) ?> 👋
            </h5>

            <small class="text-muted">
                Kelola keuangan keluarga dengan mudah
            </small>

        </div>

        <div class="dropdown">

            <button class="profile-btn dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">

                <div class="avatar-circle">
                    <?= strtoupper(substr($userName,0,1)) ?>
                </div>

            </button>

            <ul class="dropdown-menu dropdown-menu-end">

                <li>
                    <a class="dropdown-item"
                       href="/profile">

                        <i class="bi bi-person-circle me-2"></i>
                        Profil Saya

                    </a>
                </li>

                <li>
                    <a class="dropdown-item"
                       href="/change-password">

                        <i class="bi bi-shield-lock me-2"></i>
                        Ubah Password

                    </a>
                </li>

                <li><hr class="dropdown-divider"></li>

                <li>
                    <a class="dropdown-item text-danger"
                       href="/logout">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout

                    </a>
                </li>

            </ul>

        </div>

    </div>

    <!-- CONTENT -->
    <div class="page-content">

        <?= $this->renderSection('content') ?>

    </div>

</div>

<!-- OVERLAY -->
<div class="sidebar-overlay"
     id="sidebarOverlay"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="/assets/js/app.js"></script>

</body>
</html>