<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['status_login']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($koneksi, "DELETE FROM pemesanan_tiket WHERE id_tiket='$id'");
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Zoo Explorer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand text-warning fw-bold" href="index.php">
                <i class="bi bi-shield-lock-fill me-2"></i>Panel Admin Zoo
            </a>
            <div class="d-flex align-items-center">
                <span class="text-white me-3">Halo, <strong><?= htmlspecialchars($_SESSION['nama']); ?></strong></span>
                <a href="index.php" class="btn btn-outline-light btn-sm me-2">Beranda</a>
                <a href="logout.php" class="btn btn-danger btn-sm fw-bold">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5 mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold text-warning mb-0"><i class="bi bi-table me-2"></i>Data Pemesanan Tiket</h3>
        </div>

        <div class="table-responsive">
            <table class="table table-dark table-striped table-bordered align-middle">
                <thead class="table-warning text-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Tanggal Kunjungan</th>
                        <th>Jenis Tiket</th>
                        <th>Jumlah</th>
                        <th>Total Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM pemesanan_tiket ORDER BY id_tiket DESC");
                    $no = 1;
                    if (mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= htmlspecialchars($row['nama_pemesan']); ?></td>
                        <td><?= date('d M Y', strtotime($row['tanggal_kunjungan'])); ?></td>
                        <td><?= htmlspecialchars($row['jenis_tiket']); ?></td>
                        <td><?= $row['jumlah']; ?> Tiket</td>
                        <td>Rp <?= number_format($row['total_bayar'], 0, ',', '.'); ?></td>
                        <td>
                            <a href="admin.php?hapus=<?= $row['id_tiket']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data pemesanan ini?')">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-center text-secondary py-4">Belum ada data pemesanan tiket.</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>