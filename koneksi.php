<?php

$koneksi = mysqli_connect("localhost", "root", "", "db_zoo");

if (!$koneksi) {
    die("Koneksi database gagal: ");
}
?>