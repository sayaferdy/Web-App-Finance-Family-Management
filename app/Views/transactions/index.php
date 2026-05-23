<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Transaksi Keuangan
        </h3>

        <p class="text-muted mb-0">
            Kelola seluruh transaksi keuangan
        </p>

    </div>

    <a href="/transactions/create"
       class="btn btn-primary">

        <i class="bi bi-plus-lg"></i>
        Tambah Transaksi

    </a>

</div>

<?php if(session()->getFlashdata('success')): ?>

<div class="alert alert-success">

    <?= session()->getFlashdata('success') ?>

</div>

<?php endif; ?>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table modern-table">

                <thead>

                    <tr>
                        <th>Tanggal</th>
                        <th>Pengguna</th>
                        <th>Category</th>
                        <th>Scope</th>
                        <th>Type</th>
                        <th>Nominal</th>
                        <th width="180">Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach($transactions as $trx): ?>

                    <tr>

                        <td>
                            <?= date('d M Y', strtotime($trx['transaction_date'])) ?>
                        </td>

                        <td>
                            <?= esc($trx['user_name']) ?>
                        </td>

                        <td>
                            <?= esc($trx['category_name']) ?>
                        </td>

                        <td>

                            <?php if($trx['scope'] == 'shared'): ?>

                                <span class="badge bg-primary">
                                    Rumah Tangga
                                </span>

                            <?php else: ?>

                                <span class="badge bg-secondary">
                                    Pribadi
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if($trx['type'] == 'income'): ?>

                                <span class="badge bg-success">
                                    Pemasukan
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    Pengeluaran
                                </span>

                            <?php endif; ?>

                        </td>

                        <td class="fw-bold">

                            Rp <?= number_format($trx['amount'],0,',','.') ?>

                        </td>

                        <td>

                            <div class="d-flex gap-2 flex-wrap">

                                <a href="/transactions/edit/<?= $trx['id'] ?>"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a href="/transactions/delete/<?= $trx['id'] ?>"
                                   class="btn btn-danger btn-sm">

                                    Hapus

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