<?php
$galeri = [
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-1.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Bogor, Jawa Barat',
    ],
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-2.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Bogor, Jawa Barat',
    ],
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-3.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Edu Wisata Kacang Koro, Bogor',
    ],
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-4.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Bogor, Jawa Barat',
    ],
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-5.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Bogor, Jawa Barat',
    ],
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-6.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Rumah Edukasi Koro, Bogor',
    ],
    [
        'gambar'  => '/proyek-akhir/assets/pelatihan-7.jpeg',
        'judul'   => 'Pelatihan Pengolahan Produk Koro Pedang',
        'tanggal' => '25 Mei 2026',
        'lokasi'  => 'Bogor, Jawa Barat',
    ],
];
?>

<!-- PAGE HEADER -->
<section class="bg-[#0f5c5c] py-14">
    <div class="max-w-6xl mx-auto px-6">
        <span class="inline-block bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full mb-4 tracking-widest uppercase">
            Rumah Edukasi
        </span>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-3">Galeri Pelatihan</h1>
        <p class="text-white/70 text-sm">Dokumentasi kegiatan pelatihan dan edukasi Rumah Pangan Nusantara</p>
    </div>
</section>

<!-- STATS BAR -->
<section class="bg-white border-b border-gray-100">
    <div class="max-w-6xl mx-auto px-6 py-5 flex items-center gap-6 md:gap-8 flex-wrap">
        <div class="flex items-center gap-2">
            <span class="text-2xl font-bold text-[#0f5c5c]"><?= count($galeri) ?></span>
            <span class="text-sm text-gray-500">Kegiatan Terdokumentasi</span>
        </div>
        <div class="w-px h-5 bg-gray-200 hidden md:block"></div>
        <div class="flex items-center gap-2">
            <span class="text-2xl font-bold text-[#0f5c5c]">2026</span>
            <span class="text-sm text-gray-500">Tahun Aktif</span>
        </div>
        <div class="w-px h-5 bg-gray-200 hidden md:block"></div>
        <div class="flex items-center gap-2">
            <span class="text-2xl font-bold text-[#0f5c5c]">Bogor</span>
            <span class="text-sm text-gray-500">Lokasi Utama</span>
        </div>
    </div>
</section>

<!-- GALERI GRID -->
<section class="py-14 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">

        <div class="mb-10">
            <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">Dokumentasi</p>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800">Foto Kegiatan</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 md:gap-6">
            <?php foreach ($galeri as $i => $item) : ?>
            <div class="bg-white rounded-2xl overflow-hidden shadow hover:shadow-lg transition group cursor-pointer border border-gray-100"
                 onclick="openLightbox(<?= $i ?>)">
                <!-- Gambar -->
                <div class="overflow-hidden h-52 bg-gray-100">
                    <img src="<?= htmlspecialchars($item['gambar']) ?>"
                         alt="<?= htmlspecialchars($item['judul']) ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <!-- Info -->
                <div class="p-5">
                    <h3 class="font-bold text-gray-800 text-sm leading-snug mb-3 group-hover:text-[#0f5c5c] transition">
                        <?= htmlspecialchars($item['judul']) ?>
                    </h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-1.5 text-xs text-gray-400">
                            <span>📅</span>
                            <span><?= htmlspecialchars($item['tanggal']) ?></span>
                        </div>
                        <div class="flex items-center gap-1.5 text-xs text-gray-400 max-w-[120px] truncate">
                            <span>📍</span>
                            <span class="truncate"><?= htmlspecialchars($item['lokasi']) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- LIGHTBOX -->
<div id="lightbox" class="fixed inset-0 bg-black/80 z-50 hidden items-center justify-center p-3 md:p-4"
     onclick="closeLightbox(event)">
    <div class="relative max-w-3xl w-full" onclick="event.stopPropagation()">
        <!-- Tombol Tutup -->
        <button onclick="closeLightbox()"
                class="absolute -top-9 right-0 text-white/70 hover:text-white text-3xl leading-none transition">
            ×
        </button>
        <!-- Gambar -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-2xl">
            <img id="lightboxImg" src="" alt=""
                 class="w-full max-h-[50vh] md:max-h-[60vh] object-contain bg-gray-900">
            <div class="p-4 md:p-5 flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <h3 id="lightboxJudul" class="font-bold text-gray-800 text-sm md:text-base mb-1 truncate"></h3>
                    <p id="lightboxTanggal" class="text-xs text-gray-400 flex items-center gap-1">📅 </p>
                    <p id="lightboxLokasi"  class="text-xs text-gray-400 flex items-center gap-1 mt-0.5">📍 </p>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <button onclick="prevPhoto()"
                            class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition text-sm">
                        ‹
                    </button>
                    <button onclick="nextPhoto()"
                            class="w-9 h-9 rounded-xl border border-gray-200 flex items-center justify-center text-gray-500 hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition text-sm">
                        ›
                    </button>
                </div>
            </div>
        </div>
        <!-- Counter -->
        <p id="lightboxCounter" class="text-center text-white/50 text-xs mt-3"></p>
    </div>
</div>

<!-- TRAINING & MAP -->
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8 items-stretch">
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

<script>
// Data galeri untuk lightbox
const galeri = <?= json_encode(array_values($galeri)) ?>;
let currentIndex = 0;

function openLightbox(i) {
    currentIndex = i;
    updateLightbox();
    const lb = document.getElementById('lightbox');
    lb.classList.remove('hidden');
    lb.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(e) {
    if (e && e.target !== document.getElementById('lightbox') && e.type !== 'click') return;
    const lb = document.getElementById('lightbox');
    lb.classList.add('hidden');
    lb.classList.remove('flex');
    document.body.style.overflow = '';
}

function updateLightbox() {
    const item = galeri[currentIndex];
    document.getElementById('lightboxImg').src      = item.gambar;
    document.getElementById('lightboxImg').alt      = item.judul;
    document.getElementById('lightboxJudul').textContent    = item.judul;
    document.getElementById('lightboxTanggal').textContent  = '📅 ' + item.tanggal;
    document.getElementById('lightboxLokasi').textContent   = '📍 ' + item.lokasi;
    document.getElementById('lightboxCounter').textContent  = (currentIndex + 1) + ' / ' + galeri.length;
}

function prevPhoto() {
    currentIndex = (currentIndex - 1 + galeri.length) % galeri.length;
    updateLightbox();
}

function nextPhoto() {
    currentIndex = (currentIndex + 1) % galeri.length;
    updateLightbox();
}

// Navigasi keyboard
document.addEventListener('keydown', function(e) {
    const lb = document.getElementById('lightbox');
    if (lb.classList.contains('hidden')) return;
    if (e.key === 'ArrowLeft')  prevPhoto();
    if (e.key === 'ArrowRight') nextPhoto();
    if (e.key === 'Escape')     closeLightbox();
});
</script>
