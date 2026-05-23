<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <h3 class="fw-bold">
        Change Password
    </h3>

    <p class="text-muted">
        Update password akun anda
    </p>

</div>

<div class="row">

    <div class="col-lg-6">

        <div class="form-card">

            <form method="post"
                  action="/change-password/update">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Password Lama
                    </label>

                    <input type="password"
                           name="current_password"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Password Baru
                    </label>

                    <input type="password"
                           name="new_password"
                           class="form-control">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Konfirmasi Password
                    </label>

                    <input type="password"
                           name="confirm_password"
                           class="form-control">

                </div>

                <button class="btn btn-primary">

                    Update Password

                </button>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>