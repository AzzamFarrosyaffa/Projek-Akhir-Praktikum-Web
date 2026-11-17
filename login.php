<?php
session_start();
include 'koneksi.php';

if (isset($_COOKIE['login_user']) && isset($_COOKIE['role_user'])) {
    $_SESSION['status_login'] = true;
    $_SESSION['id_user']      = $_COOKIE['id_user'];
    $_SESSION['nama']         = $_COOKIE['nama_user'];
    $_SESSION['role']         = $_COOKIE['role_user'];
}

if (isset($_SESSION['status_login'])) {
    if ($_SESSION['role'] == 'admin') {
        header("Location: admin.php");
    } else {
        header("Location: riwayat.php");
    }
    exit;
}

$error = "";

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);

    $cek_admin = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($cek_admin) > 0) {
        $data = mysqli_fetch_assoc($cek_admin);

        $_SESSION['status_login'] = true;
        $_SESSION['id_user']      = $data['id_admin'];
        $_SESSION['nama']         = $data['nama'] ?? $data['username'];
        $_SESSION['role']         = 'admin';

        if (isset($_POST['remember'])) {
            setcookie('login_user', 'true', time() + (86400 * 30), "/");
            setcookie('id_user', $data['id_admin'], time() + (86400 * 30), "/");
            setcookie('nama_user', $_SESSION['nama'], time() + (86400 * 30), "/");
            setcookie('role_user', 'admin', time() + (86400 * 30), "/");
        }

        header("Location: admin.php");
        exit;
    }

    $cek_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");

    if (mysqli_num_rows($cek_user) > 0) {
        $data = mysqli_fetch_assoc($cek_user);

        $_SESSION['status_login'] = true;
        $_SESSION['id_user']      = $data['id_user'];
        $_SESSION['nama']         = $data['nama'];
        $_SESSION['role']         = 'user';

        if (isset($_POST['remember'])) {
            setcookie('login_user', 'true', time() + (86400 * 30), "/");
            setcookie('id_user', $data['id_user'], time() + (86400 * 30), "/");
            setcookie('nama_user', $data['nama'], time() + (86400 * 30), "/");
            setcookie('role_user', 'user', time() + (86400 * 30), "/");
        }

        header("Location: riwayat.php");
        exit;
    }

    $error = "Username atau Password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login | Zoo Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center py-5" style="min-height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card card-custom p-4 shadow">
                    <h4 class="text-center text-warning fw-bold mb-4">Login Zoo Explorer</h4>
                    
                    <?php if($error) echo "<div class='alert alert-danger'>$error</div>"; ?>
                    
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control bg-dark text-white border-secondary" required autocomplete="off">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="remember" id="remember">
                            <label class="form-check-label text-secondary" for="remember">Remember Me</label>
                        </div>
                        <button type="submit" name="login" class="btn btn-warning w-100 fw-bold mb-3">Login</button>
                    </form>

                    <div class="text-center text-secondary small">
                        Belum punya akun? <a href="register.php" class="text-warning text-decoration-none">Daftar di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>