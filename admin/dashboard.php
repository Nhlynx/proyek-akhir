<?php
session_start();
$title = "Dashboard | Admin Panel";
include '../koneksi.php';
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

$queryProduk = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
$dataProduk = mysqli_fetch_assoc($queryProduk);
$totalProduk = $dataProduk['total'];

$queryArtikel = mysqli_query($conn, "SELECT COUNT(*) as total FROM artikel");
$dataArtikel = mysqli_fetch_assoc($queryArtikel);
$totalArtikel = $dataArtikel['total'];

$queryUser = mysqli_query($conn, "SELECT COUNT(*) as total FROM users");
$dataUser = mysqli_fetch_assoc($queryUser);
$totalUser = $dataUser['total'];
?>
<?php include '../layout/admin/header.php'; ?>
<?php include '../layout/admin/sidebar.php'; ?>

<main class="flex-1 p-6">
    <!-- Navbar Atas -->
    <div class="bg-white p-4 rounded-xl shadow mb-6 flex justify-between">
        <h2 class="font-semibold">Dashboard Admin</h2>
        <span class="text-gray-500">Welcome, Admin</span>
    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-[#03575d] text-white p-5 rounded-xl shadow hover:scale-105 transition">
            <h3 class="text-lg">Produk</h3>
            <p class="text-3xl font-bold"><?php echo $totalProduk; ?></p>
        </div>

        <div class="bg-[#0098a7] text-white p-5 rounded-xl shadow hover:scale-105 transition">
            <h3 class="text-lg">Artikel</h3>
            <p class="text-3xl font-bold"><?php echo $totalArtikel; ?></p>
        </div>

        <div class="bg-[#7AC6D2] text-white p-5 rounded-xl shadow hover:scale-105 transition">
            <h3 class="text-lg">User</h3>
            <p class="text-3xl font-bold"><?php echo $totalUser; ?></p>
        </div>
    </div>
</main>

<?php include '../layout/admin/footer.php'; ?>