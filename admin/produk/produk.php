<?php
$title = "Data Produk | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
$totalProduk = mysqli_num_rows($query);
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Toast Notifikasi -->
    <?php if (isset($_GET['notif'])) : ?>
    <?php
        $notifMap = [
            'tambah' => ['bg' => 'bg-green-500',  'icon' => '✅', 'msg' => 'Produk berhasil ditambahkan!'],
            'edit'   => ['bg' => 'bg-blue-500',   'icon' => '✏️', 'msg' => 'Produk berhasil diperbarui!'],
            'hapus'  => ['bg' => 'bg-red-500',    'icon' => '🗑️', 'msg' => 'Produk berhasil dihapus!'],
        ];
        $n = $notifMap[$_GET['notif']] ?? null;
    ?>
    <?php if ($n) : ?>
    <div id="toast"
         class="fixed top-6 right-6 z-50 flex items-center gap-3 <?= $n['bg'] ?> text-white px-5 py-3.5 rounded-2xl shadow-xl text-sm font-semibold transition-all duration-500">
        <span><?= $n['icon'] ?></span>
        <span><?= $n['msg'] ?></span>
        <button onclick="document.getElementById('toast').remove()" class="ml-2 text-white/70 hover:text-white text-lg leading-none">×</button>
    </div>
    <script>
        setTimeout(function() {
            const t = document.getElementById('toast');
            if (t) { t.style.opacity = '0'; t.style.transform = 'translateY(-10px)'; setTimeout(() => t.remove(), 500); }
        }, 3500);
    </script>
    <?php endif; ?>
    <?php endif; ?>

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
                <h2 class="font-bold text-gray-800 text-lg">Data Produk</h2>
                <p class="text-gray-400 text-xs mt-0.5"><?= $totalProduk ?> produk terdaftar</p>
            </div>
        </div>
        <a href="tambah_produk.php"
           class="inline-flex items-center gap-1 md:gap-2 bg-[#0f5c5c] text-white px-3 md:px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#0a4444] transition shadow-sm">
            <span>+</span><span class="hidden sm:inline">Tambah Produk</span>
        </a>
    </div>

    <!-- Tabel (desktop) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden md:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">No</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Gambar</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Nama Produk</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Kategori</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Harga</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Stok</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4 text-gray-400 text-xs"><?= $no++ ?></td>
                        <td class="px-5 py-4">
                            <img src="../../uploads/<?= htmlspecialchars($row['gambar']) ?>"
                                 class="w-12 h-12 object-cover rounded-xl border border-gray-100">
                        </td>
                        <td class="px-5 py-4">
                            <p class="font-semibold text-gray-800"><?= htmlspecialchars($row['nama_produk']) ?></p>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-2 py-0.5 rounded-full">
                                <?= htmlspecialchars(ucfirst(str_replace('-', ' ', $row['kategori']))) ?>
                            </span>
                        </td>
                        <td class="px-5 py-4 font-semibold text-gray-700">
                            Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                        </td>
                        <td class="px-5 py-4">
                            <?php if ($row['stok'] == 0) : ?>
                                <span class="inline-block bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">Habis</span>
                            <?php elseif ($row['stok'] <= 5) : ?>
                                <span class="inline-block bg-orange-100 text-orange-600 text-xs font-bold px-2 py-0.5 rounded-full">
                                    <?= $row['stok'] ?> (Rendah)
                                </span>
                            <?php else : ?>
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">
                                    <?= $row['stok'] ?>
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <a href="edit_produk.php?id=<?= $row['id'] ?>"
                                   class="inline-flex items-center gap-1 bg-amber-400 hover:bg-amber-500 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                    ✏️ Edit
                                </a>
                                <a href="hapus_produk.php?id=<?= $row['id'] ?>"
                                   onclick="return confirm('Yakin ingin menghapus produk ini?')"
                                   class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                    🗑️ Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <?php if ($totalProduk === 0) : ?>
        <div class="text-center py-16">
            <p class="text-4xl mb-3">📦</p>
            <p class="text-gray-400 text-sm font-medium">Belum ada produk</p>
            <a href="tambah_produk.php" class="inline-block mt-3 text-[#0f5c5c] text-sm font-semibold hover:underline">
                + Tambah produk pertama
            </a>
        </div>
        <?php endif; ?>
    </div>

    <!-- Card View (mobile) -->
    <?php
    // Re-query untuk mobile view
    $queryMobile = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
    ?>
    <div class="md:hidden space-y-3">
        <?php while ($row = mysqli_fetch_assoc($queryMobile)) : ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center gap-3 mb-3">
                <img src="../../uploads/<?= htmlspecialchars($row['gambar']) ?>"
                     class="w-14 h-14 object-cover rounded-xl border border-gray-100 flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-gray-800 text-sm truncate"><?= htmlspecialchars($row['nama_produk']) ?></p>
                    <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-2 py-0.5 rounded-full mt-1">
                        <?= htmlspecialchars(ucfirst(str_replace('-', ' ', $row['kategori']))) ?>
                    </span>
                </div>
            </div>
            <div class="flex items-center justify-between mb-3">
                <p class="font-bold text-[#0f5c5c] text-sm">Rp<?= number_format($row['harga'], 0, ',', '.') ?></p>
                <?php if ($row['stok'] == 0) : ?>
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-0.5 rounded-full">Habis</span>
                <?php elseif ($row['stok'] <= 5) : ?>
                    <span class="bg-orange-100 text-orange-600 text-xs font-bold px-2 py-0.5 rounded-full">Stok: <?= $row['stok'] ?> (Rendah)</span>
                <?php else : ?>
                    <span class="bg-green-100 text-green-700 text-xs font-bold px-2 py-0.5 rounded-full">Stok: <?= $row['stok'] ?></span>
                <?php endif; ?>
            </div>
            <div class="flex gap-2">
                <a href="edit_produk.php?id=<?= $row['id'] ?>"
                   class="flex-1 text-center bg-amber-400 hover:bg-amber-500 text-white text-xs font-semibold py-2 rounded-lg transition">
                    ✏️ Edit
                </a>
                <a href="hapus_produk.php?id=<?= $row['id'] ?>"
                   class="flex-1 text-center bg-red-500 hover:bg-red-600 text-white text-xs font-semibold py-2 rounded-lg transition">
                    🗑️ Hapus
                </a>
            </div>
        </div>
        <?php endwhile; ?>
        <?php if ($totalProduk === 0) : ?>
        <div class="text-center py-12 bg-white rounded-2xl border border-gray-100">
            <p class="text-4xl mb-3">📦</p>
            <p class="text-gray-400 text-sm">Belum ada produk</p>
            <a href="tambah_produk.php" class="inline-block mt-2 text-[#0f5c5c] text-sm font-semibold hover:underline">+ Tambah produk pertama</a>
        </div>
        <?php endif; ?>
    </div>

</main>

<?php include '../../layout/admin/footer.php'; ?>
