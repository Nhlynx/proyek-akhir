<?php
include 'koneksi.php';
// Produk
$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 3");

// Artikel
$artikel = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id DESC LIMIT 2");
?>

<!-- Animasi Scroll Reveal -->
<style>
.reveal {
    opacity: 0;
    transform: translateY(32px);
    transition: opacity 0.6s ease, transform 0.6s ease;
}
.reveal.visible {
    opacity: 1;
    transform: translateY(0);
}
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.2s; }
.reveal-delay-3 { transition-delay: 0.3s; }
.reveal-delay-4 { transition-delay: 0.4s; }
</style>

<!-- HERO SECTION -->
<section class="py-12 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-[#0f5c5c] rounded-3xl overflow-hidden shadow-xl reveal">
            <div class="flex flex-col md:flex-row items-center gap-0">
                <!-- Teks -->
                <div class="flex-1 px-6 py-10 md:px-10 md:py-14 text-white">
                    <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-5 tracking-widest uppercase">
                        Rumah Pangan Nusantara
                    </span>
                    <h1 class="text-3xl md:text-4xl font-bold leading-tight mb-5">
                        Dari Koro Pedang,<br>Untuk Indonesia Sehat
                    </h1>
                    <p class="text-white/80 text-base leading-relaxed mb-4">
                        Kami menghadirkan produk pangan lokal inovatif berbasis kacang koro pedang —
                        tempe, tepung, kecap manis, hingga keripik tempe yang gurih dan bergizi.
                    </p>
                    <p class="text-white/70 text-sm italic mb-8">
                        "Mari makan apa yang petani kita tanam." — Agus Somamihardja
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="?page=produk"
                           class="inline-block bg-white text-[#0f5c5c] px-6 py-3 rounded-xl font-semibold hover:bg-gray-100 transition shadow">
                            Jelajahi Produk
                        </a>
                    </div>
                </div>
                <!-- Dekorasi kanan -->
                <div class="hidden md:flex flex-col items-center justify-center bg-white/10 h-full px-10 py-14 gap-4 min-w-[220px]">
                    <div class="bg-white/20 rounded-2xl p-5 text-center w-40">
                        <div class="text-3xl mb-2">🌱</div>
                        <p class="text-white font-semibold text-sm">Pangan Lokal</p>
                        <p class="text-white/70 text-xs mt-1">Berbasis koro pedang</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-5 text-center w-40">
                        <div class="text-3xl mb-2">🤝</div>
                        <p class="text-white font-semibold text-sm">Berdayakan UMKM</p>
                        <p class="text-white/70 text-xs mt-1">Mitra & pelatihan</p>
                    </div>
                    <div class="bg-white/20 rounded-2xl p-5 text-center w-40">
                        <div class="text-3xl mb-2">🏆</div>
                        <p class="text-white font-semibold text-sm">Produk Unggulan</p>
                        <p class="text-white/70 text-xs mt-1">Sehat & inovatif</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- KEUNGGULAN SECTION -->
<section class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="text-center mb-10 reveal">
            <h2 class="text-2xl md:text-3xl font-bold text-[#0f5c5c]">Mengapa Rumah Pangan Nusantara?</h2>
            <p class="text-gray-500 mt-2 text-sm">Lebih dari sekadar produk — sebuah gerakan ketahanan pangan</p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition reveal reveal-delay-1">
                <div class="w-12 h-12 bg-[#0f5c5c]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🌿</span>
                </div>
                <h3 class="font-semibold text-gray-800 text-sm">100% Lokal</h3>
                <p class="text-gray-500 text-xs mt-1">Bahan baku dari petani Indonesia</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition reveal reveal-delay-2">
                <div class="w-12 h-12 bg-[#0f5c5c]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">💪</span>
                </div>
                <h3 class="font-semibold text-gray-800 text-sm">Kaya Protein</h3>
                <p class="text-gray-500 text-xs mt-1">Sumber protein nabati terbaik</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition reveal reveal-delay-3">
                <div class="w-12 h-12 bg-[#0f5c5c]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">📚</span>
                </div>
                <h3 class="font-semibold text-gray-800 text-sm">Edukasi & Pelatihan</h3>
                <p class="text-gray-500 text-xs mt-1">Program untuk masyarakat mandiri</p>
            </div>
            <div class="bg-white rounded-2xl p-6 text-center shadow-sm hover:shadow-md transition reveal reveal-delay-4">
                <div class="w-12 h-12 bg-[#0f5c5c]/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🤝</span>
                </div>
                <h3 class="font-semibold text-gray-800 text-sm">Kemitraan UMKM</h3>
                <p class="text-gray-500 text-xs mt-1">Tumbuh bersama mitra lokal</p>
            </div>
        </div>
    </div>
</section>

<!-- PRODUK SECTION -->
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-end justify-between mb-8 reveal">
            <div>
                <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">Koleksi Terbaru</p>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Produk Unggulan</h2>
            </div>
            <a href="?page=produk" class="text-[#0f5c5c] text-sm font-semibold hover:underline hidden md:block">
                Lihat Semua →
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
            <div class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden border border-gray-100 group reveal">
                <div class="overflow-hidden h-48">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($row['gambar']); ?>"
                         alt="<?= htmlspecialchars($row['nama_produk']); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-5">
                    <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-2 py-0.5 rounded-full mb-2">
                        Produk Lokal
                    </span>
                    <h3 class="font-bold text-gray-800 text-base mb-1"><?= htmlspecialchars($row['nama_produk']); ?></h3>
                    <p class="text-[#0f5c5c] font-semibold mb-4">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
                    <a href="index.php?page=detail_produk&id=<?= $row['id'] ?>"
                       class="block bg-[#0f5c5c] text-white text-center py-2.5 rounded-xl text-sm font-semibold hover:bg-[#0a4444] transition">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="text-center mt-6 md:hidden">
            <a href="?page=produk" class="inline-block border border-[#0f5c5c] text-[#0f5c5c] px-6 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#0f5c5c] hover:text-white transition">
                Lihat Semua Produk
            </a>
        </div>
    </div>
</section>

<!-- ARTIKEL SECTION -->
<section class="py-14 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <div class="flex items-end justify-between mb-8 reveal">
            <div>
                <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">Wawasan & Inspirasi</p>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Artikel Terbaru</h2>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <?php while ($row = mysqli_fetch_assoc($artikel)) : ?>
            <a href="index.php?page=detail_artikel&slug=<?= $row['slug']; ?>"
               class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden flex gap-0 group border border-gray-100 reveal">
                <!-- Gambar -->
                <div class="w-28 md:w-36 flex-shrink-0 overflow-hidden">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($row['gambar']); ?>"
                         alt="<?= htmlspecialchars($row['judul']); ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <!-- Konten -->
                <div class="p-4 md:p-5 flex flex-col justify-between">
                    <div>
                        <p class="text-xs text-gray-400 mb-1">
                            <?= date('d F Y', strtotime($row['created_at'])); ?> &bull; <?= htmlspecialchars($row['penulis']); ?>
                        </p>
                        <h3 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-[#0f5c5c] transition mb-2">
                            <?= htmlspecialchars($row['judul']); ?>
                        </h3>
                        <p class="text-xs text-gray-500 leading-relaxed">
                            <?= substr(strip_tags($row['isi']), 0, 100); ?>...
                        </p>
                    </div>
                    <span class="text-[#0f5c5c] text-xs font-semibold mt-3 inline-block">Baca Selengkapnya →</span>
                </div>
            </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- TRAINING & MAP -->
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8 items-stretch">
            <!-- TRAINING -->
            <div class="bg-[#0f5c5c] text-white p-6 md:p-8 rounded-2xl flex flex-col justify-between shadow-lg reveal reveal-delay-1">
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
                <a href="?page=program&sub=kemitraan"
                   class="inline-block bg-white text-[#0f5c5c] text-center px-6 py-3 rounded-xl font-semibold text-sm hover:bg-gray-100 transition">
                    Pelajari Program →
                </a>
            </div>

            <!-- MAP -->
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-100 min-h-[320px] reveal reveal-delay-2">
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

<!-- CTA SECTION -->
<section class="py-14 bg-[#0f5c5c]">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="text-2xl md:text-3xl font-bold text-white mb-4 reveal">
            Siap Bergabung Bersama Kami?
        </h2>
        <p class="text-white/75 text-base mb-8 leading-relaxed reveal reveal-delay-1">
            Jadilah bagian dari gerakan pangan lokal yang sehat dan berkelanjutan.
            Bersama kita tumbuh, bersama kita kuat.
        </p>
        <div class="flex flex-wrap justify-center gap-4 reveal reveal-delay-2">
            <a href="?page=produk"
               class="inline-block bg-white text-[#0f5c5c] px-7 py-3 rounded-xl font-semibold hover:bg-gray-100 transition shadow">
                Lihat Produk
            </a>
            <a href="?page=program&sub=kemitraan"
               class="inline-block border border-white/60 text-white px-7 py-3 rounded-xl font-semibold hover:bg-white/10 transition">
                Daftar Kemitraan
            </a>
        </div>
    </div>
</section>

<script>
// Scroll Reveal dengan IntersectionObserver
const observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(entry) {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal').forEach(function(el) {
    observer.observe(el);
});
</script>
