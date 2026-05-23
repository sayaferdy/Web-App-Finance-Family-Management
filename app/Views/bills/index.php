<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h3 class="fw-bold mb-1">
            Manajemen Tagihan
        </h3>

        <p class="text-muted mb-0">
            Kelola tagihan dan pembayaran rutin
        </p>

    </div>

    <a href="/bills/create"
       class="btn btn-primary">

        <i class="bi bi-plus-lg"></i>
        Tambah Tagihan

    </a>

</div>

<div class="card">

    <div class="card-body">

        <div class="table-responsive">

            <table class="table modern-table">

                <thead>

                    <tr>
                        <th>Tagihan</th>
                        <th>Nominal</th>
                        <th>Berlaku hingga</th>
                        <th>Status</th>
                        <th>Pengingat</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                <?php foreach($bills as $bill): ?>

                    <?php

                    $today = date('Y-m-d');

                    $diff = (strtotime($bill['due_date']) - strtotime($today)) / 86400;

                    ?>

                    <tr>

                        <td>
                            <?= esc($bill['name']) ?>
                        </td>

                        <td class="fw-semibold">

                            Rp <?= number_format($bill['amount'],0,',','.') ?>

                        </td>

                        <td>
                            <?= date('d M Y', strtotime($bill['due_date'])) ?>
                        </td>

                        <td>

                            <?php if($bill['status'] == 'paid'): ?>

                                <span class="badge bg-success">
                                    Paid
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    Unpaid
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <?php if($diff < 0): ?>

                                <span class="text-danger fw-semibold">
                                    Overdue
                                </span>

                            <?php elseif($diff <= 3): ?>

                                <span class="text-warning fw-semibold">
                                    Due Soon
                                </span>

                            <?php else: ?>

                                <span class="text-success fw-semibold">
                                    Normal
                                </span>

                            <?php endif; ?>

                        </td>

                        <td>

                            <div class="d-flex gap-2 flex-wrap">

                                <a href="/bills/edit/<?= $bill['id'] ?>"
                                   class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a href="/bills/delete/<?= $bill['id'] ?>"
                                   class="btn btn-danger btn-sm">

                                    Delete

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