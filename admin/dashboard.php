<?php
session_start();
$title = "Dashboard | Admin Panel";
include '../koneksi.php';
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}

// Statistik dasar
$queryProduk  = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk");
$totalProduk  = mysqli_fetch_assoc($queryProduk)['total'];

$queryArtikel  = mysqli_query($conn, "SELECT COUNT(*) as total FROM artikel");
$totalArtikel  = mysqli_fetch_assoc($queryArtikel)['total'];

$totalKonten = $totalProduk + $totalArtikel;

// Total stok semua produk
$queryStok  = mysqli_query($conn, "SELECT SUM(stok) as total FROM produk");
$totalStok  = mysqli_fetch_assoc($queryStok)['total'] ?? 0;

// Produk stok rendah (stok <= 5)
$queryStokRendah = mysqli_query($conn, "SELECT * FROM produk WHERE stok <= 5 ORDER BY stok ASC LIMIT 5");

// 5 produk terbaru
$queryProdukTerbaru = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 5");

// 5 artikel terbaru
$queryArtikelTerbaru = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id DESC LIMIT 5");

// Kategori produk & jumlahnya
$queryKategori = mysqli_query($conn, "SELECT kategori, COUNT(*) as jumlah FROM produk GROUP BY kategori");
?>
<?php include '../layout/admin/header.php'; ?>
<?php include '../layout/admin/sidebar.php'; ?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-4 md:px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <!-- Hamburger mobile -->
            <button onclick="toggleSidebar()"
                    class="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h2 class="font-bold text-gray-800 text-lg">Dashboard</h2>
                <p class="text-gray-400 text-xs mt-0.5"><?= date('l, d F Y') ?></p>
            </div>
        </div>
        <div class="flex items-center gap-2 md:gap-3">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-semibold text-gray-700"><?= htmlspecialchars(ucfirst($_SESSION['user']['username'])) ?></p>
                <p class="text-xs text-gray-400">Rumah Pangan Nusantara</p>
            </div>
            <div class="w-9 h-9 bg-[#0f5c5c] rounded-full flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                <?= strtoupper(substr($_SESSION['user']['username'], 0, 1)) ?>
            </div>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-5 mb-6">
        <div class="bg-[#0f5c5c] text-white p-4 md:p-5 rounded-2xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-2 md:mb-3">
                <p class="text-xs font-semibold uppercase tracking-widest text-white/70">Total Produk</p>
                <span class="text-xl md:text-2xl">📦</span>
            </div>
            <p class="text-3xl md:text-4xl font-bold"><?= $totalProduk ?></p>
            <a href="/proyek-akhir/admin/produk/produk.php" class="text-white/60 text-xs mt-2 inline-block hover:text-white transition">
                Kelola →
            </a>
        </div>

        <div class="bg-white border border-gray-100 p-4 md:p-5 rounded-2xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-2 md:mb-3">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Artikel</p>
                <span class="text-xl md:text-2xl">📝</span>
            </div>
            <p class="text-3xl md:text-4xl font-bold text-gray-800"><?= $totalArtikel ?></p>
            <a href="/proyek-akhir/admin/artikel/artikel.php" class="text-[#0f5c5c] text-xs mt-2 inline-block hover:underline transition">
                Kelola →
            </a>
        </div>

        <div class="bg-white border border-gray-100 p-4 md:p-5 rounded-2xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-2 md:mb-3">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Konten</p>
                <span class="text-xl md:text-2xl">🗂️</span>
            </div>
            <p class="text-3xl md:text-4xl font-bold text-gray-800"><?= $totalKonten ?></p>
            <p class="text-gray-400 text-xs mt-2">Produk + Artikel</p>
        </div>

        <div class="bg-white border border-gray-100 p-4 md:p-5 rounded-2xl shadow hover:shadow-lg transition">
            <div class="flex items-center justify-between mb-2 md:mb-3">
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-400">Stok</p>
                <span class="text-xl md:text-2xl">🏷️</span>
            </div>
            <p class="text-3xl md:text-4xl font-bold text-gray-800"><?= number_format($totalStok) ?></p>
            <p class="text-gray-400 text-xs mt-2">Unit tersedia</p>
        </div>
    </div>

    <!-- Row 2: Produk Terbaru + Stok Rendah -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">

        <!-- Produk Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-sm">Produk Terbaru</h3>
                <a href="/proyek-akhir/admin/produk/produk.php" class="text-[#0f5c5c] text-xs font-semibold hover:underline">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-gray-50">
                <?php while ($row = mysqli_fetch_assoc($queryProdukTerbaru)) : ?>
                <div class="px-6 py-3 flex items-center gap-4 hover:bg-gray-50 transition">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($row['gambar']) ?>"
                         class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate"><?= htmlspecialchars($row['nama_produk']) ?></p>
                        <p class="text-xs text-gray-400"><?= htmlspecialchars($row['kategori']) ?></p>
                    </div>
                    <div class="text-right flex-shrink-0">
                        <p class="text-sm font-bold text-[#0f5c5c]">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
                        <p class="text-xs text-gray-400">Stok: <?= $row['stok'] ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Stok Rendah -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-sm">⚠️ Stok Rendah</h3>
                <span class="text-xs text-orange-500 font-semibold bg-orange-50 px-2 py-0.5 rounded-full">Perlu Perhatian</span>
            </div>
            <?php
            $rowsStokRendah = [];
            while ($row = mysqli_fetch_assoc($queryStokRendah)) {
                $rowsStokRendah[] = $row;
            }
            ?>
            <?php if (empty($rowsStokRendah)) : ?>
            <div class="px-6 py-10 text-center">
                <p class="text-4xl mb-2">✅</p>
                <p class="text-gray-400 text-sm">Semua stok dalam kondisi baik</p>
            </div>
            <?php else : ?>
            <div class="divide-y divide-gray-50">
                <?php foreach ($rowsStokRendah as $row) : ?>
                <div class="px-6 py-3 flex items-center gap-4 hover:bg-gray-50 transition">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($row['gambar']) ?>"
                         class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate"><?= htmlspecialchars($row['nama_produk']) ?></p>
                        <p class="text-xs text-gray-400"><?= htmlspecialchars($row['kategori']) ?></p>
                    </div>
                    <div class="flex-shrink-0">
                        <?php if ($row['stok'] == 0) : ?>
                        <span class="text-xs font-bold text-white bg-red-500 px-2 py-1 rounded-full">Habis</span>
                        <?php else : ?>
                        <span class="text-xs font-bold text-white bg-orange-400 px-2 py-1 rounded-full">
                            Sisa <?= $row['stok'] ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Row 3: Artikel Terbaru + Kategori Produk -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <!-- Artikel Terbaru -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <h3 class="font-bold text-gray-800 text-sm">Artikel Terbaru</h3>
                <a href="/proyek-akhir/admin/artikel/artikel.php" class="text-[#0f5c5c] text-xs font-semibold hover:underline">
                    Lihat Semua →
                </a>
            </div>
            <div class="divide-y divide-gray-50">
                <?php while ($row = mysqli_fetch_assoc($queryArtikelTerbaru)) : ?>
                <div class="px-6 py-3 hover:bg-gray-50 transition">
                    <p class="text-sm font-semibold text-gray-800 truncate"><?= htmlspecialchars($row['judul']) ?></p>
                    <div class="flex items-center justify-between mt-1">
                        <p class="text-xs text-gray-400">Oleh <?= htmlspecialchars($row['penulis']) ?></p>
                        <p class="text-xs text-gray-400"><?= date('d M Y', strtotime($row['created_at'])) ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

        <!-- Kategori Produk -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-sm">Sebaran Kategori Produk</h3>
            </div>
            <div class="px-6 py-4 space-y-4">
                <?php while ($row = mysqli_fetch_assoc($queryKategori)) :
                    $persen = $totalProduk > 0 ? round(($row['jumlah'] / $totalProduk) * 100) : 0;
                ?>
                <div>
                    <div class="flex items-center justify-between mb-1">
                        <p class="text-sm font-semibold text-gray-700"><?= htmlspecialchars(ucfirst(str_replace('-', ' ', $row['kategori']))) ?></p>
                        <p class="text-xs text-gray-400"><?= $row['jumlah'] ?> produk (<?= $persen ?>%)</p>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-[#0f5c5c] h-2 rounded-full transition-all duration-500"
                             style="width: <?= $persen ?>%"></div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

    </div>

    <!-- Quick Actions -->
    <div class="mt-6 bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6">
        <h3 class="font-bold text-gray-800 text-sm mb-4">Aksi Cepat</h3>
        <div class="grid grid-cols-2 md:flex md:flex-wrap gap-3">
            <a href="/proyek-akhir/admin/produk/tambah_produk.php"
               class="inline-flex items-center justify-center gap-2 bg-[#0f5c5c] text-white px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#0a4444] transition">
                + Tambah Produk
            </a>
            <a href="/proyek-akhir/admin/artikel/tambah_artikel.php"
               class="inline-flex items-center justify-center gap-2 bg-white border border-[#0f5c5c] text-[#0f5c5c] px-4 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#0f5c5c] hover:text-white transition">
                + Tambah Artikel
            </a>
            <a href="/proyek-akhir/admin/produk/produk.php"
               class="inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
                📦 Kelola Produk
            </a>
            <a href="/proyek-akhir/admin/artikel/artikel.php"
               class="inline-flex items-center justify-center gap-2 bg-white border border-gray-200 text-gray-600 px-4 py-2.5 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
                📝 Kelola Artikel
            </a>
        </div>
    </div>

</main>

<?php include '../layout/admin/footer.php'; ?>
