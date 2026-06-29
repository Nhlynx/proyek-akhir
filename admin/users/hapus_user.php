<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../auth/login.php");
    exit;
}
include '../../koneksi.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Validasi keamanan: Mencegah menghapus diri sendiri
    if ($id == $_SESSION['user']['id']) {
        header("Location: users.php?notif=gagal_hapus_diri_sendiri");
        exit;
    }
    
    $query = mysqli_query($conn, "DELETE FROM users WHERE id = '$id'");
    if ($query) {
        header("Location: users.php?notif=hapus");
        exit;
    } else {
        header("Location: users.php?notif=error");
        exit;
    }
} else {
    header("Location: users.php");
    exit;
}
?>
