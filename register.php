<?php
session_start();
include 'koneksi.php';

$pesan = "";

if (isset($_POST['register'])) {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $cek_user  = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
    $cek_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username'");

    if (mysqli_num_rows($cek_user) > 0 || mysqli_num_rows($cek_admin) > 0) {
        $pesan = "<div class='alert alert-danger'>Username sudah terdaftar! Gunakan username lain.</div>";
    } else {
        $query = "INSERT INTO users (nama, username, password, role) VALUES ('$nama', '$username', '$password', 'user')";
        if (mysqli_query($koneksi, $query)) {
            $pesan = "<div class='alert alert-success'>Pendaftaran berhasil! Silakan <a href='login.php' class='alert-link'>Login di sini</a>.</div>";
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal mendaftar: " . mysqli_error($koneksi) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Akun | Zoo Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card card-custom p-4 shadow">
                    <h4 class="text-center text-warning fw-bold mb-4">Daftar Akun Zoo Explorer</h4>
                    
                    <?= $pesan; ?>

                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control bg-dark text-white border-secondary" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control bg-dark text-white border-secondary" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-warning w-100 fw-bold mb-3">Daftar Sekarang</button>
                    </form>

                    <div class="text-center text-secondary small">
                        Sudah punya akun? <a href="login.php" class="text-warning text-decoration-none">Login di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>