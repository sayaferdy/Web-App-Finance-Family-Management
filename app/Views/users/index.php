<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">

    <!-- =========================================
    PAGE HEADER
    ========================================== -->
    <div class="page-header">

        <div>

            <h1 class="page-title">
                User Management
            </h1>

            <p class="page-subtitle">
                Kelola user dan role sistem keluarga
            </p>

        </div>

        <a href="/users/create"
           class="btn btn-primary modern-btn">

            <i class="bi bi-plus-circle me-1"></i>

            Add User

        </a>

    </div>

    <!-- =========================================
    FLASH MESSAGE
    ========================================== -->

    <?php if(session()->getFlashdata('success')): ?>

        <div class="alert alert-success border-0 shadow-sm">

            <i class="bi bi-check-circle me-2"></i>

            <?= session()->getFlashdata('success') ?>

        </div>

    <?php endif; ?>

    <?php if(session()->getFlashdata('error')): ?>

        <div class="alert alert-danger border-0 shadow-sm">

            <i class="bi bi-exclamation-circle me-2"></i>

            <?= session()->getFlashdata('error') ?>

        </div>

    <?php endif; ?>

    <!-- =========================================
    TABLE CARD
    ========================================== -->

    <div class="modern-card table-card">

        <div class="table-responsive">

            <table class="table modern-table align-middle">

                <thead>

                    <tr>

                        <th width="90">
                            ID
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Username
                        </th>

                        <th width="180">
                            Role
                        </th>

                        <th width="240">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if(!empty($users)): ?>

                        <?php foreach ($users as $u): ?>

                            <?php
                            $role = strtoupper($u['role']);

                            $roleClass = match($role){

                                'SUPERADMIN' => 'role-superadmin',
                                'ADMIN'      => 'role-admin',

                                default      => 'role-member'
                            };
                            ?>

                            <tr>

                                <!-- ID -->
                                <td>

                                    <strong>
                                        #<?= $u['id'] ?>
                                    </strong>

                                </td>

                                <!-- NAME -->
                                <td>

                                    <strong>
                                        <?= esc($u['name']) ?>
                                    </strong>

                                </td>

                                <!-- USERNAME -->
                                <td>

                                    <span class="text-muted">
                                        @<?= esc($u['username']) ?>
                                    </span>

                                </td>

                                <!-- ROLE -->
                                <td>

                                    <span class="role-badge <?= $roleClass ?>">

                                        <?= $role ?>

                                    </span>

                                </td>

                                <!-- ACTION -->
                                <td>

                                    <div class="table-action">

                                        <!-- EDIT -->
                                        <a href="/users/edit/<?= $u['id'] ?>"
                                           class="btn btn-warning btn-sm">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                        <!-- RESET PASSWORD -->
                                        <a href="/users/reset-password/<?= $u['id'] ?>"
                                           class="btn btn-info btn-sm"
                                           onclick="return confirm('Reset password user ini?')">

                                            <i class="bi bi-key"></i>

                                        </a>

                                        <!-- DELETE -->
                                        <a href="/users/delete/<?= $u['id'] ?>"
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('Hapus user ini?')">

                                            <i class="bi bi-trash"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <!-- EMPTY STATE -->
                        <tr>

                            <td colspan="5">

                                <div class="empty-state">

                                    <i class="bi bi-people"></i>

                                    <h4>
                                        No Users Found
                                    </h4>

                                    <p class="text-muted">

                                        Belum ada data user tersedia

                                    </p>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>