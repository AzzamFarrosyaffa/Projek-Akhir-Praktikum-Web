<?php
session_start();

if (!isset($_SESSION['status_login']) && isset($_COOKIE['login_user']) && isset($_COOKIE['role_user'])) {
    $_SESSION['status_login'] = true;
    $_SESSION['id_user']      = $_COOKIE['id_user'];
    $_SESSION['nama']         = $_COOKIE['nama_user'];
    $_SESSION['role']         = $_COOKIE['role_user'];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zoo Explorer | Kebun Binatang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-warning" href="index.php">
                <i class="bi bi-tree-fill me-2"></i>Zoo Explorer
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link active" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fasilitas">Fasilitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#satwa">Satwa</a></li>

                    <?php if (isset($_SESSION['status_login'])): ?>
                        <?php if ($_SESSION['role'] == 'admin'): ?>
                            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="admin.php">Panel Admin</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" href="tiket.php">Beli Tiket</a></li>
                            <li class="nav-item"><a class="nav-link text-warning fw-bold" href="riwayat.php">Tiket Saya</a></li>
                        <?php endif; ?>
                        <li class="nav-item ms-lg-2">
                            <a href="logout.php" class="btn btn-outline-danger btn-sm fw-bold rounded-pill px-3">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link text-warning fw-bold" href="login.php">Login</a></li>
                        <li class="nav-item ms-lg-2">
                            <a href="register.php" class="btn btn-warning fw-bold rounded-pill px-4">Daftar Akun</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero-section text-center text-white mt-5">
        <div class="container py-5">
            <h1 class="display-3 fw-bold mb-3">Jelajahi Alam Liar</h1>
            <p class="lead mb-4 mx-auto" style="max-width: 700px;">Petualangan tak terlupakan menanti Anda dan keluarga di Zoo Explorer. Temukan ribuan spesies eksotis dari seluruh dunia.</p>
            <a href="tiket.php" class="btn btn-warning btn-lg fw-bold rounded-pill px-5">Pesan Tiket Sekarang</a>
        </div>
    </header>

    <section id="fasilitas" class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-warning">Fasilitas Unggulan</h2>
            <p class="text-secondary">Kenyamanan pengunjung adalah prioritas utama kami.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="bi bi-bus-front mb-3 d-inline-block"></i>
                    <h4>Safari Bus</h4>
                    <p class="text-secondary mb-0">Berkeliling area zona Afrika tanpa lelah menggunakan bus safari ber-AC.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="bi bi-camera mb-3 d-inline-block"></i>
                    <h4>Photo Session</h4>
                    <p class="text-secondary mb-0">Abadikan momen langka berfoto langsung dengan satwa jinak didampingi pawang.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <i class="bi bi-cup-hot mb-3 d-inline-block"></i>
                    <h4>Food Court Alam</h4>
                    <p class="text-secondary mb-0">Nikmati hidangan lezat di area terbuka dengan pemandangan danau alam.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="satwa" class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-warning">Primadona Kami</h2>
            <p class="text-secondary">Spesies paling populer di Zoo Explorer</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card card-custom h-100">
                    <div class="card-img-wrapper position-relative">
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3">Mamalia</span>
                        <img src="aset/Harimau.jpg" alt="Harimau Sumatera">
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold">Harimau Sumatera</h4>
                        <p class="text-warning small fst-italic">Panthera tigris sumatrae</p>
                        <p class="text-secondary">Karnivora eksotis dengan loreng menawan di zona Asia tropis.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom h-100">
                    <div class="card-img-wrapper position-relative">
                        <span class="badge bg-danger position-absolute top-0 end-0 m-3">Reptil</span>
                        <img src="aset/Komodo.jpg" alt="Komodo">
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold">Komodo</h4>
                        <p class="text-warning small fst-italic">Varanus komodoensis</p>
                        <p class="text-secondary">Kadal terbesar di dunia predator puncak khas Nusantara.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-custom h-100">
                    <div class="card-img-wrapper position-relative">
                        <span class="badge bg-info text-dark position-absolute top-0 end-0 m-3">Aves</span>
                        <img src="aset/Macaw.jpg" alt="Burung Macaw">
                    </div>
                    <div class="card-body">
                        <h4 class="fw-bold">Burung Macaw</h4>
                        <p class="text-warning small fst-italic">Ara macao</p>
                        <p class="text-secondary">Burung eksotis yang cerdas dengan warna bulu mencolok.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-4 text-center text-secondary">
        <div class="container">
            <p class="mb-1 fw-bold text-white"><i class="bi bi-tree-fill text-warning me-2"></i>Zoo Explorer</p>
            <p class="small mb-0">&copy; 2026 Zoo Explorer Project. Built with Bootstrap 5 & PHP Native.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>