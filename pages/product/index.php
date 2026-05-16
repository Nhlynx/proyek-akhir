<?php
$limit = 4;
$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
$start = ($page - 1) * $limit;
$kategori = isset($_GET['kategori']) ? urldecode($_GET['kategori']) : null;
$heroQuery = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 1");
$heroData = mysqli_fetch_assoc($heroQuery);

$where = "";
if ($kategori) {
    $kategori_safe = mysqli_real_escape_string($conn, $kategori);
    $where = "WHERE kategori = '$kategori_safe'";
}

$query = mysqli_query($conn, "SELECT * FROM produk $where ORDER BY id DESC LIMIT $start, $limit");

$total = mysqli_query($conn, "SELECT COUNT(*) as total FROM produk $where");

$totalData = mysqli_fetch_assoc($total)['total'];
$totalPage = ceil($totalData / $limit);

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}
$listData = $data;

// Ambil semua kategori untuk filter
$kategoriQuery = mysqli_query($conn, "SELECT DISTINCT kategori FROM produk");
$kategoriList = [];
while ($k = mysqli_fetch_assoc($kategoriQuery)) {
    $kategoriList[] = $k['kategori'];
}
?>

<!-- PAGE HEADER -->
<section class="bg-[#0f5c5c] py-14">
    <div class="max-w-6xl mx-auto px-6">
        <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-widest uppercase">
            Koleksi Kami
        </span>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Produk Unggulan</h1>
        <p class="text-white/70 text-sm">Produk pangan lokal inovatif berbasis kacang koro pedang</p>
    </div>
</section>

<!-- HERO PRODUK TERBARU -->
<?php if ($heroData) : ?>
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-gray-50 rounded-3xl overflow-hidden border border-gray-100 shadow-sm">
            <div class="grid md:grid-cols-2 gap-0 items-stretch">
                <!-- Gambar -->
                <div class="overflow-hidden h-72 md:h-auto">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($heroData['gambar']) ?>"
                         alt="<?= htmlspecialchars($heroData['nama_produk']) ?>"
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <!-- Info -->
                <div class="p-8 md:p-10 flex flex-col justify-center">
                    <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-3 py-1 rounded-full mb-4 uppercase tracking-widest">
                        Produk Terbaru
                    </span>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                        <?= htmlspecialchars($heroData['nama_produk']) ?>
                    </h2>
                    <p class="text-xs text-gray-400 mb-3 uppercase tracking-wide">
                        <?= htmlspecialchars($heroData['kategori']) ?>
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">
                        <?= htmlspecialchars(substr($heroData['deskripsi'], 0, 150)) ?>...
                    </p>
                    <p class="text-[#0f5c5c] text-2xl font-bold mb-6">
                        Rp<?= number_format($heroData['harga'], 0, ',', '.') ?>
                    </p>
                    <a href="index.php?page=detail_produk&id=<?= $heroData['id'] ?>"
                       class="inline-block bg-[#0f5c5c] text-white px-6 py-3 rounded-xl font-semibold text-sm hover:bg-[#0a4444] transition w-fit">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- FILTER & LIST PRODUK -->
<section class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <!-- Filter Kategori -->
        <div class="flex flex-wrap gap-2 mb-8">
            <a href="index.php?page=produk"
               class="px-4 py-2 rounded-xl text-sm font-semibold border transition
                      <?= !$kategori ? 'bg-[#0f5c5c] text-white border-[#0f5c5c]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#0f5c5c] hover:text-[#0f5c5c]' ?>">
                Semua
            </a>
            <?php foreach ($kategoriList as $kat) : ?>
            <a href="index.php?page=produk&kategori=<?= urlencode($kat) ?>"
               class="px-4 py-2 rounded-xl text-sm font-semibold border transition
                      <?= ($kategori === $kat) ? 'bg-[#0f5c5c] text-white border-[#0f5c5c]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#0f5c5c] hover:text-[#0f5c5c]' ?>">
                <?= htmlspecialchars(ucfirst(str_replace('-', ' ', $kat))) ?>
            </a>
            <?php endforeach; ?>
        </div>

        <!-- Judul Section -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">
                    <?= $kategori ? 'Kategori' : 'Semua Produk' ?>
                </p>
                <h2 class="text-2xl font-bold text-gray-800">
                    <?= $kategori ? htmlspecialchars($kategori) : 'Daftar Produk' ?>
                </h2>
            </div>
            <p class="text-gray-400 text-sm hidden md:block"><?= $totalData ?> produk ditemukan</p>
        </div>

        <!-- Grid Produk -->
        <?php if (empty($listData)) : ?>
        <div class="text-center py-20">
            <div class="text-5xl mb-4">🔍</div>
            <p class="text-gray-500 font-medium">Produk tidak ditemukan</p>
            <a href="index.php?page=produk" class="inline-block mt-4 text-[#0f5c5c] text-sm font-semibold hover:underline">
                Lihat semua produk →
            </a>
        </div>
        <?php else : ?>
        <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-5">
            <?php foreach ($listData as $row) : ?>
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden border border-gray-100 group">
                <div class="overflow-hidden h-44">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($row['gambar']) ?>"
                         alt="<?= htmlspecialchars($row['nama_produk']) ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-4">
                    <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-2 py-0.5 rounded-full mb-2">
                        <?= htmlspecialchars(ucfirst(str_replace('-', ' ', $row['kategori']))) ?>
                    </span>
                    <h3 class="font-bold text-gray-800 text-sm mb-1 leading-snug">
                        <?= htmlspecialchars($row['nama_produk']) ?>
                    </h3>
                    <p class="text-gray-400 text-xs mb-3 leading-relaxed">
                        <?= htmlspecialchars(substr($row['deskripsi'], 0, 60)) ?>...
                    </p>
                    <p class="text-[#0f5c5c] font-bold text-sm mb-3">
                        Rp<?= number_format($row['harga'], 0, ',', '.') ?>
                    </p>
                    <a href="index.php?page=detail_produk&id=<?= $row['id'] ?>"
                       class="block bg-[#0f5c5c] text-white text-center py-2 rounded-xl text-xs font-semibold hover:bg-[#0a4444] transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if ($totalPage > 1) : ?>
        <div class="flex justify-center mt-10 gap-2">
            <?php if ($page > 1) : ?>
            <a href="index.php?page=produk&halaman=<?= $page - 1 ?><?= $kategori ? '&kategori=' . urlencode($kategori) : '' ?>"
               class="px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
                ← Prev
            </a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPage; $i++) : ?>
            <a href="index.php?page=produk&halaman=<?= $i ?><?= $kategori ? '&kategori=' . urlencode($kategori) : '' ?>"
               class="px-4 py-2 rounded-xl border text-sm font-semibold transition
                      <?= ($i == $page) ? 'bg-[#0f5c5c] text-white border-[#0f5c5c]' : 'bg-white text-gray-600 border-gray-200 hover:border-[#0f5c5c] hover:text-[#0f5c5c]' ?>">
                <?= $i ?>
            </a>
            <?php endfor; ?>

            <?php if ($page < $totalPage) : ?>
            <a href="index.php?page=produk&halaman=<?= $page + 1 ?><?= $kategori ? '&kategori=' . urlencode($kategori) : '' ?>"
               class="px-4 py-2 rounded-xl border border-gray-200 bg-white text-gray-600 text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
                Next →
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>

    </div>
</section>

<!-- TRAINING & MAP -->
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8 items-stretch">
            <!-- TRAINING -->
            <div class="bg-[#0f5c5c] text-white p-8 rounded-2xl flex flex-col justify-between shadow-lg">
                <div>
                    <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-5 tracking-widest uppercase">
                        Program Kami
                    </span>
                    <h3 class="text-2xl font-bold mb-3">Training & Kemitraan</h3>
                    <p class="text-white/70 text-sm mb-6 leading-relaxed">
                        Bergabunglah dengan jaringan mitra kami dan ikuti program pelatihan untuk mengembangkan usaha berbasis pangan lokal.
                    </p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-center gap-3 text-sm">
                            <span class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center text-xs">✔</span>
                            Gabung Menjadi Mitra
                        </li>
                        <li class="flex items-center gap-3 text-sm">
                            <span class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center text-xs">✔</span>
                            Jadwal Training UMK
                        </li>
                        <li class="flex items-center gap-3 text-sm">
                            <span class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center text-xs">✔</span>
                            Mitra Terbaik 2025
                        </li>
                    </ul>
                </div>
                <a href="index.php?page=program&sub=kemitraan"
                   class="inline-block bg-white text-[#0f5c5c] text-center px-6 py-3 rounded-xl font-semibold text-sm hover:bg-gray-100 transition">
                    Pelajari Program →
                </a>
            </div>

            <!-- MAP -->
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 min-h-[320px]">
                <div class="bg-[#0f5c5c] px-6 py-4">
                    <p class="text-white font-semibold text-sm">📍 Lokasi Kami</p>
                    <p class="text-white/70 text-xs mt-0.5">Edu Wisata Kacang Koro, Bogor</p>
                </div>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.6324733308907!2d106.7785327!3d-6.5679856999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c51074b3edd3%3A0x95da583e68404ad!2sEdu%20Wisata%20Kacang%20Koro!5e0!3m2!1sen!2sid!4v1776310737142!5m2!1sen!2sid"
                    width="100%" height="100%" style="border:0; min-height: 280px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade" title="Lokasi Rumah Pangan Nusantara">
                </iframe>
            </div>
        </div>
    </div>
</section>
