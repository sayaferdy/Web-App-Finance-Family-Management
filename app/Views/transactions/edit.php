<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php
$role = session()->get('role');
?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Edit Transaksi
            </h1>

            <p class="page-subtitle">
                Update data transaksi keluarga
            </p>

        </div>

        <a href="/transactions"
           class="btn btn-light-primary">

            <i class="bi bi-arrow-left me-1"></i>

            Back

        </a>

    </div>

    <div class="modern-card form-card">

        <form action="/transactions/update/<?= $transaction['id'] ?>"
              method="post"
              enctype="multipart/form-data">

            <div class="row">

                <!-- TYPE -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Type
                    </label>

                    <select name="type"
                            class="form-select modern-input">

                        <option value="income"
                            <?= $transaction['type'] == 'income'
                                ? 'selected'
                                : '' ?>>

                            Pemasukan

                        </option>

                        <option value="expense"
                            <?= $transaction['type'] == 'expense'
                                ? 'selected'
                                : '' ?>>

                            Pengeluaran

                        </option>

                    </select>

                </div>

                <!-- CATEGORY -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Category
                    </label>

                    <select name="category_id"
                            class="form-select modern-input">

                        <?php foreach($categories as $category): ?>

                            <option value="<?= $category['id'] ?>"
                                <?= $transaction['category_id'] == $category['id']
                                    ? 'selected'
                                    : '' ?>>

                                <?= esc($category['name']) ?>

                            </option>

                        <?php endforeach; ?>

                    </select>

                </div>

                <!-- SCOPE -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Scope
                    </label>

                    <?php if($role === 'MEMBER'): ?>

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

                            <option value="shared"
                                <?= $transaction['scope'] == 'shared'
                                    ? 'selected'
                                    : '' ?>>

                                Rumah Tangga

                            </option>

                            <option value="personal"
                                <?= $transaction['scope'] == 'personal'
                                    ? 'selected'
                                    : '' ?>>

                                Pribadi

                            </option>

                        </select>

                    <?php endif; ?>

                </div>

                <!-- AMOUNT -->
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
                               value="<?= $transaction['amount'] ?>"
                               required>

                    </div>

                </div>

                <!-- DATE -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Tanggal
                    </label>

                    <input type="date"
                           name="transaction_date"
                           class="form-control modern-input"
                           value="<?= $transaction['transaction_date'] ?>"
                           required>

                </div>

                <!-- RECEIPT -->
                <div class="col-md-6 mb-4">

                    <label class="form-label">
                        Bukti Transaksi (Opsional)
                    </label>

                    <input type="file"
                           name="receipt"
                           class="form-control modern-input">

                    <input type="hidden"
                           name="old_receipt"
                           value="<?= $transaction['receipt'] ?>">

                    <?php if(!empty($transaction['receipt'])): ?>

                        <div class="mt-3">

                            <small class="text-muted d-block mb-2">
                                Current Receipt
                            </small>

                            <a href="/uploads/receipts/<?= $transaction['receipt'] ?>"
                               target="_blank"
                               class="btn btn-sm btn-light-primary">

                                <i class="bi bi-file-earmark-image me-1"></i>

                                View Receipt

                            </a>

                        </div>

                    <?php endif; ?>

                </div>

                <!-- DESCRIPTION -->
                <div class="col-md-12 mb-4">

                    <label class="form-label">
                        Catatan
                    </label>

                    <textarea name="description"
                              rows="4"
                              class="form-control modern-input"
                              placeholder="Tambahkan catatan transaksi..."><?= esc($transaction['description']) ?></textarea>

                </div>

            </div>

            <div class="form-action d-flex gap-2 flex-wrap">

                <button class="btn btn-success modern-btn">

                    <i class="bi bi-check-circle me-1"></i>

                    Update Transaksi

                </button>

                <a href="/transactions"
                   class="btn btn-light-primary modern-btn">

                    Batalkan

                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>