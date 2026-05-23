<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Tambah Budget
            </h1>

            <p class="page-subtitle">
                Kelola budget bulanan keluarga
            </p>

        </div>

        <a href="/budgets"
           class="btn btn-light-primary">

            <i class="bi bi-arrow-left me-1"></i>

            Back

        </a>

    </div>

    <div class="modern-card form-card">

        <form method="post"
              action="/budgets/store">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Category
                    </label>

                    <select name="category_id"
                            class="form-select modern-input">

                        <?php foreach($categories as $c): ?>

                            <option value="<?= $c['id'] ?>">

                                <?= esc($c['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <div class="col-md-3 mb-4">

                    <label class="form-label">
                        Bulan
                    </label>

                    <input type="number"
                           name="month"
                           class="form-control modern-input"
                           placeholder="1-12"
                           required>

                </div>

                <div class="col-md-3 mb-4">

                    <label class="form-label">
                        Tahun
                    </label>

                    <input type="number"
                           name="year"
                           class="form-control modern-input"
                           placeholder="2026"
                           required>

                </div>

                <div class="col-md-12 mb-4">

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

            </div>

            <div class="form-action">

                <button class="btn btn-success modern-btn">

                    <i class="bi bi-check-circle me-1"></i>

                    Simpan Budget

                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>