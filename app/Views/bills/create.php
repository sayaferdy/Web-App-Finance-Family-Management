<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Tambah Tagihan
            </h1>

            <p class="page-subtitle">
                Tambahkan tagihan rumah tangga baru
            </p>

        </div>

        <a href="/bills"
           class="btn btn-light-primary">

            <i class="bi bi-arrow-left me-1"></i>

            Back

        </a>

    </div>

    <div class="modern-card form-card">

        <form method="post"
              action="/bills/store">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Nama Tagihan
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control modern-input"
                           placeholder="Contoh: Internet Bulanan"
                           required>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Nominal
                    </label>

                    <div class="input-group">

                        <span class="input-group-text">
                            Rp
                        </span>

                        <input type="number"
                               name="amount"
                               class="form-control modern-input"
                               placeholder="0"
                               required>

                    </div>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Berlaku hingga
                    </label>

                    <input type="date"
                           name="due_date"
                           class="form-control modern-input"
                           required>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select modern-input">

                        <option value="unpaid">
                            Unpaid
                        </option>

                        <option value="paid">
                            Paid
                        </option>

                    </select>

                </div>

            </div>

            <div class="form-action">

                <button class="btn btn-success modern-btn">

                    <i class="bi bi-check-circle me-1"></i>

                    Simpan Tagihan

                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>