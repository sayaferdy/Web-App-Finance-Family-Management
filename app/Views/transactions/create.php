<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Add Transaction
            </h1>

            <p class="page-subtitle">
                Tambahkan transaksi baru
            </p>

        </div>

    </div>

    <div class="modern-card form-card">

        <form method="post"
              action="/transactions/store"
              enctype="multipart/form-data">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Type
                    </label>

                    <select name="type"
                            class="form-select modern-input">

                        <option value="income">
                            Pemasukan
                        </option>

                        <option value="expense">
                            Pengeluaran
                        </option>

                    </select>

                </div>

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

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Scope
                    </label>

                    <?php if(session()->get('role') === 'MEMBER'): ?>

                        <input type="hidden"
                               name="scope"
                               value="personal">

                        <input type="text"
                               class="form-control modern-input"
                               value="Personal"
                               disabled>

                    <?php else: ?>

                        <select name="scope"
                                class="form-select modern-input">

                            <option value="shared">
                                Rumah Tangga
                            </option>

                            <option value="personal">
                                Pribadi
                            </option>

                        </select>

                    <?php endif; ?>

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
                        Tanggal
                    </label>

                    <input type="date"
                           name="transaction_date"
                           class="form-control modern-input"
                           required>

                </div>

                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Bukti Transaksi (Opsional)
                    </label>

                    <input type="file"
                           name="receipt"
                           class="form-control modern-input">

                </div>

                <div class="col-md-12 mb-4">

                    <label class="form-label">
                        Catatan
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="form-control modern-input"
                              placeholder="Tambahkan catatan transaksi..."></textarea>

                </div>

            </div>

            <div class="form-action">

                <button class="btn btn-success modern-btn">

                    <i class="bi bi-check-circle me-1"></i>

                    Simpan Transaksi

                </button>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>