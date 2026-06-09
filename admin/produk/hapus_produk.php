<?php
include '../../koneksi.php';

$id = $_GET['id'] ?? 0;

// Ambil data produk
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    header("Location: produk.php");
    exit;
}

// Proses hapus jika konfirmasi dikirim
if (isset($_POST['konfirmasi'])) {
    if ($row['gambar'] != '') {
        $filePath = "../../uploads/" . $row['gambar'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
    mysqli_query($conn, "DELETE FROM produk WHERE id='$id'");
    header("Location: produk.php?notif=hapus");
    exit;
}
?>
<?php
$title = "Hapus Produk | Admin Panel";
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-4 md:px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()"
                    class="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h2 class="font-bold text-gray-800 text-lg">Hapus Produk</h2>
                <p class="text-gray-400 text-xs mt-0.5">Konfirmasi penghapusan produk</p>
            </div>
        </div>
        <a href="produk.php"
           class="inline-flex items-center gap-2 border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
            ← Kembali
        </a>
    </div>

    <!-- Konfirmasi Card -->
    <div class="max-w-lg mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-red-100 overflow-hidden">
            <div class="bg-red-50 px-6 py-4 border-b border-red-100">
                <p class="text-red-600 font-semibold text-sm">⚠️ Konfirmasi Penghapusan</p>
            </div>
            <div class="p-6">
                <!-- Preview Produk -->
                <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-4 mb-6 border border-gray-100">
                    <img src="../../uploads/<?= htmlspecialchars($row['gambar']) ?>"
                         class="w-16 h-16 object-cover rounded-xl border border-gray-200 flex-shrink-0">
                    <div>
                        <p class="font-bold text-gray-800"><?= htmlspecialchars($row['nama_produk']) ?></p>
                        <p class="text-xs text-gray-400 mt-0.5"><?= htmlspecialchars(ucfirst(str_replace('-', ' ', $row['kategori']))) ?></p>
                        <p class="text-sm font-semibold text-[#0f5c5c] mt-1">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
                    </div>
                </div>

                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Apakah kamu yakin ingin menghapus produk ini? Tindakan ini
                    <span class="font-semibold text-red-500">tidak dapat dibatalkan</span>
                    dan gambar produk juga akan ikut dihapus.
                </p>

                <form method="POST" class="flex gap-3">
                    <button type="submit" name="konfirmasi"
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold text-sm transition">
                        🗑️ Ya, Hapus Produk
                    </button>
                    <a href="produk.php"
                       class="flex-1 text-center border border-gray-200 text-gray-600 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>

</main>

<?php include '../../layout/admin/footer.php'; ?>
