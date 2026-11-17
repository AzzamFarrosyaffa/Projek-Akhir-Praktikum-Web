<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login'])) {
    header("Location: login.php");
    exit;
}

$id_user = $_SESSION['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM pemesanan_tiket WHERE id_user='$id_user' ORDER BY id_tiket DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pemesanan | Zoo Explorer</title>
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
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="tiket.php">Beli Tiket Lagi</a></li>
                <li class="nav-item"><a class="nav-link active text-warning" href="riwayat.php">Tiket Saya</a></li>
                <li class="nav-item"><a class="nav-link text-danger ms-2" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5 pt-5 mb-5">
        <h3 class="fw-bold text-warning mb-2"><i class="bi bi-receipt me-2"></i>Hasil Pemesanan Tiket</h3>
        <p class="text-secondary mb-4">Halo <strong><?= $_SESSION['nama']; ?></strong>, berikut adalah bukti pemesanan tiket Anda.</p>

        <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'sukses'): ?>
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <strong>Pemesanan Berhasil!</strong> Tiket Anda telah resmi terdaftar. Silakan tunjukkan bukti di bawah ini saat berkunjung.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php elseif (isset($_GET['pesan']) && $_GET['pesan'] == 'update_sukses'): ?>
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                <strong>Berhasil Diperbarui!</strong> Nama pemegang tiket dan tanggal kunjungan telah diubah.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php 
            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) { 
            ?>
                <div class="col-md-6">
                    <div class="card card-custom p-4 border-warning shadow">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-warning text-dark px-3 py-2 fw-bold">E-TICKET ZOO #<?= $row['id_tiket']; ?></span>
                            <small class="text-secondary"><?= date('d M Y - H:i', strtotime($row['tanggal_transaksi'])); ?></small>
                        </div>
                        
                        <h4 class="fw-bold text-white mb-3"><?= $row['nama_pemesan']; ?></h4>
                        
                        <div class="row text-secondary mb-3">
                            <div class="col-6">
                                <small class="d-block text-muted">Tanggal Kunjungan</small>
                                <strong class="text-white"><?= date('d F Y', strtotime($row['tanggal_kunjungan'])); ?></strong>
                            </div>
                            <div class="col-6">
                                <small class="d-block text-muted">Jenis Tiket</small>
                                <strong class="text-white"><?= $row['jenis_tiket']; ?> (<?= $row['jumlah']; ?> Pcs)</strong>
                            </div>
                        </div>

                        <hr class="border-secondary">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-secondary">Total Pembayaran:</span>
                            <h4 class="text-warning fw-bold mb-0">Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?></h4>
                        </div>

                        <!-- Tombol Update Data -->
                        <div class="text-end">
                            <a href="edit.php?id=<?= $row['id_tiket']; ?>" class="btn btn-outline-warning btn-sm fw-bold">
                                <i class="bi bi-pencil-square me-1"></i>Ubah Nama / Jadwal
                            </a>
                        </div>
                    </div>
                </div>
            <?php 
                }
            } else {
            ?>
                <div class="col-12 text-center py-5">
                    <i class="bi bi-ticket-detailed text-secondary display-1 mb-3 d-block"></i>
                    <h5 class="text-secondary">Anda belum pernah memesan tiket.</h5>
                    <a href="tiket.php" class="btn btn-warning fw-bold mt-2">Pesan Tiket Sekarang</a>
                </div>
            <?php } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>