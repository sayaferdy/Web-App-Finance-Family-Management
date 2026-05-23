<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <h3 class="fw-bold">
        Profile saya
    </h3>

    <p class="text-muted">
        Kelola informasi akun anda
    </p>

</div>

<div class="row">

    <div class="col-lg-7">

        <div class="form-card">

            <div class="text-center mb-4">

                <div class="profile-avatar">

                    <?= strtoupper(substr($user['name'],0,1)) ?>

                </div>

                <h4 class="fw-bold mb-1">
                    <?= esc($user['name']) ?>
                </h4>

                <small class="text-muted">
                    <?= strtoupper($user['role']) ?>
                </small>

            </div>

            <form method="post"
                  action="/profile/update">

                <?= csrf_field() ?>

                <div class="mb-3">

                    <label class="form-label">
                        Nama
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="<?= esc($user['name']) ?>">

                </div>

                <div class="mb-4">

                    <label class="form-label">
                        Username
                    </label>

                    <input type="text"
                           name="username"
                           class="form-control"
                           value="<?= esc($user['username']) ?>">

                </div>

                <button class="btn btn-primary">

                    Simpan Perubahan

                </button>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>