<?php
// Produk
$produk = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 3");

// Artikel
$artikel = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id DESC LIMIT 2");
?>

<!-- HERO SECTION -->
<section class="py-10">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-[#0f5c5c] text-white py-16 px-8 rounded-2xl text-center">
        <h1 class="text-3xl md:text-4xl font-bold leading-snug mb-5">
            Selamat Datang di <br>
            Rumah Pangan Nusantara Bogor
        </h1>

        <p class="text-base md:text-lg text-gray-200 mb-6 leading-relaxed">
            Kami percaya bahwa pangan lokal adalah masa depan. Dari kacang koro pedang,
            sumber protein nabati yang kaya manfaat, kami menghadirkan beragam produk sehat
            dan inovatif: tempe koro pedang, tepung koro pedang untuk aneka olahan seperti
            cookies & brownies, kecap manis, hingga keripik tempe yang gurih dan renyah.</p>

        <p class="text-base md:text-lg text-gray-200 mb-8 leading-relaxed">
            Lebih dari sekadar produk, Rumah Koro adalah gerakan untuk memperkuat ketahanan
            pangan lokal. Kami mendampingi petani, mendukung UMKM, serta mengadakan pelatihan
            agar masyarakat bisa mandiri.</p>

        <p class="text-base md:text-lg text-gray-200 mb-8 leading-relaxed">
            Mari tumbuh bersama, mencintai pangan lokal, dan membangun masa depan yang lebih sehat serta berkelanjutan.</p>

        <p class="text-base md:text-lg text-gray-200 mb-8 leading-relaxed">“Mari makan apa yang petani kita tanam.” -Agus Somamihardja</p>

        <a href="?page=produk" class="inline-block bg-white text-[#0f5c5c] px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
            Jelajahi Produk</a>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="py-10">
    <div class="max-w-6xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-md p-10 text-center">
            <h2 class="text-2xl font-bold mb-4">Tentang Kami</h2>
            <p class="text-gray-600 leading-relaxed max-w-3xl mx-auto">
                Kami menghadirkan beragam produk sehat dan inovatif berbasis kacang koro pedang,
                mulai dari tepung hingga olahan seperti cookies, brownies, dan keripik tempe.
                Lebih dari sekadar produk, kami adalah gerakan untuk memperkuat ketahanan pangan lokal
                dan memberdayakan petani serta UMKM.
            </p>
        </div>
    </div>
</section>


<!-- PRODUK SECTION -->
<section class="py-16 bg-gray-50">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-center text-gray-800">Produk Unggulan</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php while ($row = mysqli_fetch_assoc($produk)) : ?>
            <div class="bg-white rounded-xl shadow p-4">
                <img src="/proyek-akhir/uploads/<?= $row['gambar']; ?>" class="w-full h-40 object-cover rounded-lg mb-3">
                <h3 class="font-semibold text-lg"><?= $row['nama_produk']; ?></h3>
                <p class="text-gray-600 mb-3">Rp<?= number_format($row['harga'], 0, ',', '.'); ?></p>
                <a href="index.php?page=detail_produk&id=<?= $row['id'] ?>" class="block bg-green-700 text-white text-center py-2 rounded-lg hover:bg-green-800">
                   Beli Sekarang</a>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<!-- ARTIKEL SECTION -->
<section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-800 mb-8">Artikel Rumah Pangan Nusantara</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <?php while ($row = mysqli_fetch_assoc($artikel)) : ?>
            <div class="bg-white rounded-xl shadow p-4 flex gap-4 hover:shadow-lg transition">
                <!-- GAMBAR -->
                <a href="index.php?page=detail_artikel&slug=<?= $row['slug']; ?>">
                    <img src="/proyek-akhir/uploads/<?= $row['gambar']; ?>" class="w-24 h-24 object-cover rounded-lg hover:opacity-90 transition">
                </a>
                <!-- KONTEN -->
                <div>
                    <!-- JUDUL -->
                    <a href="index.php?page=detail_artikel&slug=<?= $row['slug']; ?>">
                        <h3 class="font-semibold hover:text-green-600 transition"><?= $row['judul']; ?></h3>
                    </a>
                    <!-- PENULIS -->
                    <p class="text-sm text-gray-500 mt-1">Oleh <?= $row['penulis']; ?></p>
                    <!-- TANGGAL -->
                    <p class="text-xs text-gray-400"><?= date('d F Y', strtotime($row['created_at'])); ?></p>
                    <!-- POTONGAN ISI -->
                    <p class="text-sm text-gray-600 mt-2"><?= substr(strip_tags($row['isi']), 0, 80); ?>...</p>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>


<!-- TRAINING & MAP -->
<section class="py-16 bg-gray-100">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-8">
        <!-- TRAINING -->
        <div class="bg-[#0f5c5c] text-white p-6 rounded-xl">
            <h3 class="text-2xl font-bold mb-4">Training & Kemitraan</h3>
            <ul class="space-y-3">
                <li>✔ Gabung Menjadi Mitra</li>
                <li>✔ Jadwal Training UMK</li>
                <li>✔ Mitra Terbaik 2025</li>
            </ul>
        </div>

        <!-- MAP -->
        <div class="rounded-xl overflow-hidden shadow">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.6324733308907!2d106.7785327!3d-6.5679856999999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c51074b3edd3%3A0x95da583e68404ad!2sEdu%20Wisata%20Kacang%20Koro!5e0!3m2!1sen!2sid!4v1776310737142!5m2!1sen!2sid" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>