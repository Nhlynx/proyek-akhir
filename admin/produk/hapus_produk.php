<?php
include '../../koneksi.php';

$id = $_GET['id'];

// ambil gambar dulu
$data = mysqli_query($conn, "SELECT gambar FROM produk WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// hapus file gambar (optional tapi bagus)
if ($row['gambar'] != '') {
    unlink("../uploads/" . $row['gambar']);
}

// hapus dari database
mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");

// redirect
header("Location: produk.php");
exit;