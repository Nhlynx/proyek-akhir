<?php
$slug    = $_GET['slug'] ?? '';
$query   = mysqli_query($conn, "SELECT * FROM artikel WHERE slug = '$slug'");
$related = mysqli_query($conn, "SELECT * FROM artikel WHERE slug != '$slug' LIMIT 3");
$data    = mysqli_fetch_assoc($query);
if (!$data) {
    echo "<div class='max-w-4xl mx-auto px-6 py-20 text-center'>
            <p class='text-5xl mb-4'>📄</p>
            <h1 class='text-2xl font-bold text-gray-700 mb-2'>Artikel tidak ditemukan</h1>
            <a href='index.php' class='text-[#0f5c5c] font-semibold hover:underline'>← Kembali ke Beranda</a>
          </div>";
    exit;
}
?>

<!-- BREADCRUMB -->
<section class="bg-gray-50 border-b border-gray-100 py-3">
    <div class="max-w-4xl mx-auto px-6">
        <p class="text-xs text-gray-400">
            <a href="index.php" class="hover:text-[#0f5c5c] transition">Home</a>
            <span class="mx-2">›</span>
            <span class="text-gray-600"><?= htmlspecialchars($data['judul']) ?></span>
        </p>
    </div>
</section>

<!-- ARTIKEL UTAMA -->
<section class="py-14 bg-white">
    <div class="max-w-4xl mx-auto px-6">

        <!-- Header Artikel -->
        <div class="mb-8">
            <div class="flex items-center gap-2 mb-4">
                <span class="inline-block bg-[#0f5c5c]/10 text-[#0f5c5c] text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-widest">
                    Artikel
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 leading-tight mb-5">
                <?= htmlspecialchars($data['judul']) ?>
            </h1>
            <!-- Meta -->
            <div class="flex items-center gap-4 flex-wrap">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-[#0f5c5c] rounded-full flex items-center justify-center text-white text-xs font-bold">
                        <?= strtoupper(substr($data['penulis'], 0, 1)) ?>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700"><?= htmlspecialchars($data['penulis']) ?></p>
                        <p class="text-xs text-gray-400"><?= date('d F Y', strtotime($data['created_at'])) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gambar Utama -->
        <div class="rounded-2xl overflow-hidden shadow-md mb-10 bg-gray-100">
            <img src="/proyek-akhir/uploads/<?= htmlspecialchars($data['gambar']) ?>"
                 alt="<?= htmlspecialchars($data['judul']) ?>"
                 class="w-full object-cover max-h-[480px]">
        </div>

        <!-- Isi Artikel -->
        <div class="prose prose-gray max-w-none text-gray-700 leading-relaxed text-justify space-y-4
                    prose-headings:text-gray-800 prose-headings:font-bold
                    prose-a:text-[#0f5c5c] prose-a:underline">
            <?= nl2br(htmlspecialchars_decode(htmlspecialchars($data['isi'], ENT_NOQUOTES))) ?>
        </div>

        <!-- Divider -->
        <hr class="my-12 border-gray-100">

        <!-- Tombol Kembali -->
        <a href="index.php"
           class="inline-flex items-center gap-2 border border-gray-200 text-gray-600 px-5 py-2.5 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
            ← Kembali ke Beranda
        </a>

    </div>
</section>

<!-- ARTIKEL LAINNYA -->
<?php
$relatedRows = [];
while ($r = mysqli_fetch_assoc($related)) {
    $relatedRows[] = $r;
}
if (!empty($relatedRows)) :
?>
<section class="py-14 bg-gray-50">
    <div class="max-w-4xl mx-auto px-6">
        <div class="mb-8">
            <p class="text-[#0f5c5c] text-sm font-semibold uppercase tracking-widest mb-1">Baca Juga</p>
            <h2 class="text-2xl font-bold text-gray-800">Artikel Lainnya</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-5">
            <?php foreach ($relatedRows as $r) : ?>
            <a href="index.php?page=detail_artikel&slug=<?= htmlspecialchars($r['slug']) ?>"
               class="bg-white rounded-2xl shadow hover:shadow-lg transition overflow-hidden border border-gray-100 group">
                <div class="overflow-hidden h-40">
                    <img src="/proyek-akhir/uploads/<?= htmlspecialchars($r['gambar']) ?>"
                         alt="<?= htmlspecialchars($r['judul']) ?>"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <div class="p-4">
                    <p class="text-xs text-gray-400 mb-1"><?= date('d M Y', strtotime($r['created_at'])) ?></p>
                    <h3 class="font-bold text-gray-800 text-sm leading-snug group-hover:text-[#0f5c5c] transition mb-2">
                        <?= htmlspecialchars($r['judul']) ?>
                    </h3>
                    <span class="text-[#0f5c5c] text-xs font-semibold">Baca Selengkapnya →</span>
                </div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- TRAINING & MAP -->
<section class="py-14 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid md:grid-cols-2 gap-8 items-stretch">
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
