<?php
$id = $_GET['id'] ?? 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
$produk = mysqli_fetch_assoc($query);

// Produk terkait (selain produk ini)
$related = mysqli_query($conn, "SELECT * FROM produk WHERE id != '$id' LIMIT 3");

// Link WhatsApp
$no_wa = "6285817800307";
$pesan = "Halo admin, saya tertarik dengan produk:\n\n"
        . "Nama: " . $produk['nama_produk'] . "\n"
        . "Harga: Rp" . number_format($produk['harga']) . "\n"
        . "Stok: " . $produk['stok'] . "\n\n"
        . "Apakah masih tersedia?";
$link_wa = "https://wa.me/$no_wa?text=" . urlencode($pesan);
?>

<!-- BREADCRUMB -->
<section class="bg-gray-50 border-b border-gray-100 py-3">
    <div class="max-w-6xl mx-auto px-6">
        <p class="text-xs text-gray-400">
            <a href="index.php" class="hover:text-[#0f5c5c] transition">Home</a>
            <span class="mx-2">›</span>
            <a href="index.php?page=produk" class="hover:text-[#0f5c5c] transition">Produk</a>
            <span class="mx-2">›</span>
            <span class="text-gray-600"><?= htmlspecialchars($produk['nama_produk']) ?></span>
        </p>
    </div>
</section>

<!-- DETAIL PRODUK -->
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-start">

            <!-- GAMBAR -->
            <div class="md:sticky md:top-24">
                <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 bg-gray-50 h-72 md:h-96">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($produk['gambar']) ?>"
                         alt="<?= htmlspecialchars($produk['nama_produk']) ?>"
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
            </div>

            <!-- INFO -->
            <div>
                <!-- Badge Kategori -->
                <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-3 py-1 rounded-full mb-4 uppercase tracking-widest">
                    <?= htmlspecialchars($produk['kategori']) ?>
                </span>

                <!-- Nama Produk -->
                <h1 class="text-2xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
                    <?= htmlspecialchars($produk['nama_produk']) ?>
                </h1>

                <!-- Harga -->
                <div class="bg-gray-50 rounded-2xl px-4 md:px-6 py-4 mb-5 inline-block w-full md:w-auto">
                    <p class="text-xs text-gray-400 uppercase tracking-widest mb-1">Harga</p>
                    <p class="text-3xl font-bold text-[#0f5c5c]">
                        Rp<?= number_format($produk['harga'], 0, ',', '.') ?>
                    </p>
                </div>

                <!-- Stok -->
                <div class="mb-6">
                    <?php if ($produk['stok'] > 0) : ?>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 bg-green-500 rounded-full inline-block"></span>
                        <span class="text-green-600 font-semibold text-sm">
                            Stok tersedia
                        </span>
                        <span class="text-gray-400 text-sm">(<?= $produk['stok'] ?> unit)</span>
                    </div>
                    <?php else : ?>
                    <div class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 bg-red-500 rounded-full inline-block"></span>
                        <span class="text-red-500 font-semibold text-sm">Stok habis</span>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Divider -->
                <hr class="border-gray-100 mb-6">

                <!-- Deskripsi singkat -->
                <p class="text-gray-500 text-sm leading-relaxed mb-8">
                    <?= htmlspecialchars(substr($produk['deskripsi'], 0, 200)) ?>...
                </p>

                <!-- Tombol WA -->
                <a href="<?= $link_wa ?>" target="_blank"
                   class="inline-flex items-center gap-3 bg-[#0f5c5c] hover:bg-[#0a4444] text-white px-7 py-4 rounded-2xl font-semibold text-sm shadow-lg transition w-full justify-center md:w-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 fill-white" viewBox="0 0 24 24">
                        <path d="M20.52 3.48A11.93 11.93 0 0 0 12 0C5.37 0 0 5.37 0 12c0 2.11.55 4.16 1.6 5.97L0 24l6.22-1.57A11.94 11.94 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.2-1.25-6.21-3.48-8.52zM12 22c-1.85 0-3.66-.5-5.23-1.44l-.37-.22-3.69.93.99-3.59-.24-.38A9.94 9.94 0 0 1 2 12C2 6.48 6.48 2 12 2c2.67 0 5.18 1.04 7.07 2.93A9.93 9.93 0 0 1 22 12c0 5.52-4.48 10-10 10zm5.44-7.4c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.47-.89-.79-1.49-1.76-1.66-2.06-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.07-.15-.67-1.6-.92-2.2-.24-.57-.49-.5-.67-.5h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.09 4.49.71.31 1.27.49 1.7.63.72.23 1.37.2 1.88.12.57-.09 1.76-.72 2.01-1.41.25-.69.25-1.28.17-1.41-.07-.12-.27-.2-.57-.35z"/>
                    </svg>
                    Pesan via WhatsApp
                </a>

                <!-- Info tambahan -->
                <div class="mt-6 grid grid-cols-2 gap-3">
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-gray-400 mb-1">Kategori</p>
                        <p class="text-sm font-semibold text-gray-700"><?= htmlspecialchars(ucfirst($produk['kategori'])) ?></p>
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-gray-400 mb-1">Ketersediaan</p>
                        <p class="text-sm font-semibold <?= $produk['stok'] > 0 ? 'text-green-600' : 'text-red-500' ?>">
                            <?= $produk['stok'] > 0 ? 'Tersedia' : 'Habis' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- DESKRIPSI LENGKAP -->
        <div class="mt-16">
            <div class="mb-6">
                <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">Informasi Produk</p>
                <h2 class="text-2xl font-bold text-gray-800">Deskripsi Produk</h2>
            </div>
            <div class="bg-gray-50 rounded-2xl p-5 md:p-8 border border-gray-100">
                <p class="text-gray-600 leading-relaxed">
                    <?= nl2br(htmlspecialchars($produk['deskripsi'])) ?>
                </p>
            </div>
        </div>

        <!-- PRODUK TERKAIT -->
        <div class="mt-16">
            <div class="flex items-end justify-between mb-6">
                <div>
                    <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">Rekomendasi</p>
                    <h2 class="text-2xl font-bold text-gray-800">Produk Terkait</h2>
                </div>
                <a href="index.php?page=produk" class="text-[#0f5c5c] text-sm font-semibold hover:underline hidden md:block">
                    Lihat Semua →
                </a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-6">
                <?php while ($r = mysqli_fetch_assoc($related)) : ?>
                <div class="bg-white rounded-2xl border border-gray-100 shadow hover:shadow-lg transition overflow-hidden group">
                    <div class="overflow-hidden h-44">
                        <img src="/proyek-akhir/uploads/<?= htmlspecialchars($r['gambar']) ?>"
                             alt="<?= htmlspecialchars($r['nama_produk']) ?>"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    </div>
                    <div class="p-5">
                        <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-2 py-0.5 rounded-full mb-2">
                            <?= htmlspecialchars(ucfirst($r['kategori'])) ?>
                        </span>
                        <h3 class="font-bold text-gray-800 text-sm mb-1"><?= htmlspecialchars($r['nama_produk']) ?></h3>
                        <p class="text-[#0f5c5c] font-bold text-sm mb-3">
                            Rp<?= number_format($r['harga'], 0, ',', '.') ?>
                        </p>
                        <a href="index.php?page=detail_produk&id=<?= $r['id'] ?>"
                           class="block bg-[#0f5c5c] text-white text-center py-2 rounded-xl text-xs font-semibold hover:bg-[#0a4444] transition">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<!-- TRAINING & MAP -->
<section class="py-14 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8 items-stretch">
            <!-- TRAINING -->
            <div class="bg-[#0f5c5c] text-white p-6 md:p-8 rounded-2xl flex flex-col justify-between shadow-lg">
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
