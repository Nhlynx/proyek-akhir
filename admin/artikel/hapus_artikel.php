<?php
include '../../koneksi.php';

$id = $_GET['id'];

// ambil gambar dulu
$data = mysqli_query($conn, "SELECT gambar FROM artikel WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// hapus gambar jika ada
if ($row['gambar'] != '') {
    unlink("../../uploads/" . $row['gambar']);
}

// hapus dari database
mysqli_query($conn, "DELETE FROM artikel WHERE id='$id'");

// redirect
header("Location: artikel.php");
exit;