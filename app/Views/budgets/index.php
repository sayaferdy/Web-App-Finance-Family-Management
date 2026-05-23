<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">

    <div class="page-header">

        <div>

            <h1 class="page-title">
                Budget Management
            </h1>

            <p class="page-subtitle">
                Monitor budget pengeluaran keluarga
            </p>

        </div>

        <a href="/budgets/create"
           class="btn btn-primary modern-btn">

            <i class="bi bi-plus-circle me-1"></i>

            Add Budget

        </a>

    </div>

    <div class="modern-card table-card">

        <div class="table-responsive">

            <table class="table modern-table align-middle">

                <thead>

                    <tr>
                        <th>Category</th>
                        <th>Bulan</th>
                        <th>Tahun</th>
                        <th>Budget</th>
                        <th width="180">Action</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach($budgets as $b): ?>

                    <tr>

                        <td>

                            <strong>
                                <?= esc($b['category_name']) ?>
                            </strong>

                        </td>

                        <td>
                            <?= esc($b['month']) ?>
                        </td>

                        <td>
                            <?= esc($b['year']) ?>
                        </td>

                        <td>

                            <span class="money-text income">

                                Rp <?= number_format($b['amount'],0,',','.') ?>

                            </span>

                        </td>

                        <td>

                            <div class="table-action">

                                <a href="/budgets/edit/<?= $b['id'] ?>"
                                   class="btn btn-warning btn-sm">

                                    <i class="bi bi-pencil-square"></i>

                                </a>

                                <a href="/budgets/delete/<?= $b['id'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Delete budget?')">

                                    <i class="bi bi-trash"></i>

                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>