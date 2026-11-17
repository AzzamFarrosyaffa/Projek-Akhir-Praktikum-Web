<?php
session_start();
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

if (!isset($_SESSION['status_login']) || !isset($_GET['id'])) {
    header("Location: riwayat.php");
    exit;
}

$id_tiket = intval($_GET['id']);
$id_user  = $_SESSION['id_user'];

$query = mysqli_query($koneksi, "SELECT * FROM pemesanan_tiket WHERE id_tiket='$id_tiket' AND id_user='$id_user'");
$data  = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: riwayat.php");
    exit;
}

if (isset($_POST['update'])) {
    $hari_ini = date('Y-m-d');
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
    $tanggal  = mysqli_real_escape_string($koneksi, $_POST['tanggal_kunjungan']);

    if ($tanggal <= $hari_ini) {
        $error = "Input tidak valid (Tanggal telah terlewat)";
    } else {
        $update = mysqli_query($koneksi, "UPDATE pemesanan_tiket SET 
            nama_pemesan = '$nama',
            tanggal_kunjungan = '$tanggal'
            WHERE id_tiket = '$id_tiket' AND id_user = '$id_user'");

        if ($update) {
            header("Location: riwayat.php?pesan=update_sukses");
            exit;
        } else {
            $error = "Gagal mengubah data tiket: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Jadwal & Nama | Zoo Explorer</title>
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
                    <li class="nav-item"><a class="nav-link" href="riwayat.php">Tiket Saya</a></li>
                    <li class="nav-item"><a class="nav-link text-danger ms-2" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card card-custom p-4 shadow">
                    <h4 class="fw-bold text-center text-warning mb-1">Ubah Data E-Ticket #<?= $data['id_tiket']; ?></h4>
                    <p class="text-center text-secondary small mb-4">Hanya nama pengunjung dan tanggal kunjungan yang dapat diubah.</p>
                    
                    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-warning fw-bold">Nama Lengkap Pemegang Tiket</label>
                            <input type="text" name="nama_pemesan" class="form-control bg-dark text-white border-warning" value="<?= htmlspecialchars($data['nama_pemesan']); ?>" required autocomplete="off">
                        </div>
                        
                        <div class="mb-4">
                            <label class="form-label text-warning fw-bold">Tanggal Kunjungan Baru</label>
                            <input type="date" name="tanggal_kunjungan" class="form-control bg-dark text-white border-warning" value="<?= $data['tanggal_kunjungan']; ?>" required>
                        </div>

                        <div class="p-3 rounded bg-dark border border-secondary mb-4">
                            <small class="text-secondary d-block mb-2">Detail Paket (Terkunci):</small>
                            <div class="d-flex justify-content-between">
                                <span><?= $data['jenis_tiket']; ?> (<?= $data['jumlah']; ?> Tiket)</span>
                                <strong class="text-warning">Rp <?= number_format($data['total_bayar'], 0, ',', '.'); ?></strong>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="riwayat.php" class="btn btn-outline-secondary w-50 fw-bold">Batal</a>
                            <button type="submit" name="update" class="btn btn-warning w-50 fw-bold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>