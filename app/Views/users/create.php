<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f5f6f8;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .header-title {
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h3 class="header-title mb-4">Tambah User</h3>

                    <form method="post" action="/users/store">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" placeholder="Nama lengkap" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="SUPERADMIN">SUPERADMIN</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="MEMBER">MEMBER</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/users" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>