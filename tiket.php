<?php
session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

$pesan = "";

if (isset($_POST['submit'])) {
    $hari_ini    = date('Y-m-d');
    $id_user     = $_SESSION['id_user'];
    $nama        = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
    $tanggal     = mysqli_real_escape_string($koneksi, $_POST['tanggal_kunjungan']);
    $jenis       = mysqli_real_escape_string($koneksi, $_POST['jenis_tiket']);
    $jumlah      = intval($_POST['jumlah']);
    $total_bayar = intval($_POST['total_bayar']);

    if ($tanggal <= $hari_ini) {
        $pesan = "<div class='alert alert-danger'>Input tidak valid (Tanggal telah terlewat)</div>";
    } else {
        $query = "INSERT INTO pemesanan_tiket (id_user, nama_pemesan, tanggal_kunjungan, jenis_tiket, jumlah, total_bayar) 
                  VALUES ('$id_user', '$nama', '$tanggal', '$jenis', '$jumlah', '$total_bayar')";
        
        if (mysqli_query($koneksi, $query)) {
            header("Location: riwayat.php?pesan=sukses");
            exit;
        } else {
            $pesan = "<div class='alert alert-danger'>Gagal memesan tiket: " . mysqli_error($koneksi) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beli Tiket | Zoo Explorer</title>
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link active" href="tiket.php">Beli Tiket</a></li>
                    <li class="nav-item"><a class="nav-link text-warning" href="riwayat.php">Tiket Saya</a></li>
                    <li class="nav-item"><a class="nav-link text-danger ms-2" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom p-4 shadow">
                    <h3 class="fw-bold text-center text-warning mb-4"><i class="bi bi-ticket-perforated me-2"></i>Pemesanan Tiket</h3>
                    
                    <?= $pesan; ?>

                    <form action="tiket.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap Pemesan</label>
                            <input type="text" name="nama_pemesan" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($_SESSION['nama']); ?>" required autocomplete="off">
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Tanggal Kunjungan</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control bg-dark text-white border-secondary" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jenis Tiket</label>
                            <select name="jenis_tiket" id="jenis_tiket" class="form-select bg-dark text-white border-secondary" onchange="hitungTotal()" required>
                                <option value="" disabled selected>Pilih Jenis Tiket...</option>
                                <option value="Dewasa">Dewasa (Rp 50.000)</option>
                                <option value="Anak">Anak-anak (Rp 35.000)</option>
                                <option value="Keluarga">Paket Keluarga 4 Orang (Rp 150.000)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jumlah Tiket</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control bg-dark text-white border-secondary" min="1" value="1" onkeyup="hitungTotal()" onchange="hitungTotal()" required>
                        </div>

                        <hr class="border-secondary">
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h5 class="mb-0">Total Bayar:</h5>
                            <h3 class="text-warning fw-bold mb-0" id="tampil_total">Rp 0</h3>
                        </div>
                        
                        <input type="hidden" name="total_bayar" id="total_bayar" value="0">
                        <button type="submit" name="submit" class="btn btn-warning w-100 fw-bold py-2">Konfirmasi Pemesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>