<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Login - Rumahku</title>

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
    <link rel="stylesheet"
          href="/assets/css/auth.css">

</head>

<body>

<div class="auth-wrapper">

    <!-- LEFT -->
    <div class="auth-left">

        <div class="brand-box">

            <div class="brand-icon">
                <i class="bi bi-wallet2"></i>
            </div>

            <h1>Rumahku Finance</h1>

            <p>
                Kelola keuangan keluarga lebih mudah,
                modern, dan terstruktur.
            </p>

        </div>

    </div>

    <!-- RIGHT -->
    <div class="auth-right">

        <div class="login-card">

            <div class="mb-4">

                <h3 class="fw-bold">
                    Welcome Back 👋
                </h3>

                <p class="text-muted mb-0">
                    Login untuk melanjutkan
                </p>

            </div>

            <?php if(session()->getFlashdata('error')): ?>

                <div class="alert alert-danger">

                    <?= session()->getFlashdata('error') ?>

                </div>

            <?php endif; ?>

            <form action="/process-login"
                  method="post">

                <div class="mb-3">

                    <label class="form-label">
                        Username
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-person"></i>
                        </span>

                        <input type="text"
                               name="username"
                               class="form-control"
                               placeholder="Masukkan username"
                               required>

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Password
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>

                        <input type="password"
                               name="password"
                               class="form-control"
                               placeholder="Masukkan password"
                               required>

                    </div>

                </div>

                <button class="btn btn-primary w-100 auth-btn">

                    Login

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>