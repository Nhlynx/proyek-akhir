<?php
include '../../koneksi.php';

$id = $_GET['id'] ?? 0;

// Ambil data artikel
$data = mysqli_query($conn, "SELECT * FROM artikel WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (!$row) {
    header("Location: artikel.php");
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
    mysqli_query($conn, "DELETE FROM artikel WHERE id='$id'");
    header("Location: artikel.php?notif=hapus");
    exit;
}
?>
<?php
$title = "Hapus Artikel | Admin Panel";
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Hapus Artikel</h2>
            <p class="text-gray-400 text-xs mt-0.5">Konfirmasi penghapusan artikel</p>
        </div>
        <a href="artikel.php"
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
                <!-- Preview Artikel -->
                <div class="flex items-start gap-4 bg-gray-50 rounded-xl p-4 mb-6 border border-gray-100">
                    <?php if ($row['gambar']) : ?>
                    <img src="../../uploads/<?= htmlspecialchars($row['gambar']) ?>"
                         class="w-16 h-16 object-cover rounded-xl border border-gray-200 flex-shrink-0">
                    <?php else : ?>
                    <div class="w-16 h-16 bg-gray-200 rounded-xl flex items-center justify-center text-2xl flex-shrink-0">📄</div>
                    <?php endif; ?>
                    <div>
                        <p class="font-bold text-gray-800 leading-snug"><?= htmlspecialchars($row['judul']) ?></p>
                        <p class="text-xs text-gray-400 mt-1">Oleh <?= htmlspecialchars($row['penulis']) ?></p>
                        <p class="text-xs text-gray-400"><?= date('d M Y', strtotime($row['created_at'])) ?></p>
                    </div>
                </div>

                <p class="text-gray-600 text-sm leading-relaxed mb-6">
                    Apakah kamu yakin ingin menghapus artikel ini? Tindakan ini
                    <span class="font-semibold text-red-500">tidak dapat dibatalkan</span>
                    dan gambar artikel juga akan ikut dihapus.
                </p>

                <form method="POST" class="flex gap-3">
                    <button type="submit" name="konfirmasi"
                            class="flex-1 bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold text-sm transition">
                        🗑️ Ya, Hapus Artikel
                    </button>
                    <a href="artikel.php"
                       class="flex-1 text-center border border-gray-200 text-gray-600 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                </form>
            </div>
        </div>
    </div>

</main>

<?php include '../../layout/admin/footer.php'; ?>
