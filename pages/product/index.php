<?php
$limit = 4;
$page = $_GET['halaman'] ?? 1;
$start = ($page - 1) * $limit;
$kategori = $_GET['kategori'] ?? null;

/* =========================
   🔥 HERO (SELALU TERBARU)
========================= */
$heroQuery = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC LIMIT 1");
$heroData = mysqli_fetch_assoc($heroQuery);

/* =========================
   🔍 LIST PRODUK (FILTER)
========================= */
if($kategori) {
    $query = mysqli_query($conn, "
        SELECT * FROM produk 
        WHERE kategori = '$kategori'
        ORDER BY id DESC
        LIMIT $start, $limit
    ");
    $total = mysqli_query($conn, "
        SELECT COUNT(*) as total FROM produk 
        WHERE kategori = '$kategori'
    ");
} else {
    $query = mysqli_query($conn, "
        SELECT * FROM produk 
        ORDER BY id DESC
        LIMIT $start, $limit
    ");
    $total = mysqli_query($conn, "
        SELECT COUNT(*) as total FROM produk
    ");
}

$totalData = mysqli_fetch_assoc($total)['total'];
$totalPage = ceil($totalData / $limit);

/* =========================
   ARRAY DATA
========================= */
$data = [];
while($row = mysqli_fetch_assoc($query)) {
    $data[] = $row;
}

// list tetap semua data (tidak perlu slice lagi)
$listData = $data;
?>

<div class="max-w-5xl mx-auto px-4 py-8">

<?php if($heroData) { ?>
<!-- 🔥 HERO PRODUK -->
<div class="mb-10">
    <h1 class="text-2xl font-bold mb-6">Produk Terbaru</h1>
    <div class="grid md:grid-cols-2 gap-6 items-center">
        <img src="uploads/<?= $heroData['gambar'] ?>" class="w-full h-64 object-cover rounded-xl hover:scale-105 transition">
        <div>
            <h2 class="text-2xl font-bold">
                <?= $heroData['nama_produk'] ?>
            </h2>

            <p class="text-gray-600 mt-2">
                <?= substr($heroData['deskripsi'], 0, 150) ?>...
            </p>

            <p class="text-green-600 text-xl font-bold mt-3">
                Rp <?= number_format($heroData['harga']) ?>
            </p>

            <a href="index.php?page=detail&id=<?= $heroData['id'] ?>"
               class="inline-block mt-4 bg-green-600 text-white px-5 py-2 rounded-lg">
               Lihat Detail
            </a>
        </div>

    </div>
</div>
<?php } ?>

<!-- 🔥 LIST PRODUK -->
<h2 class="text-xl font-bold mb-4">
    <?= $kategori ? 'Kategori: ' . ucfirst(str_replace('-', ' ', $kategori)) : 'Semua Produk' ?>
</h2>
<?php if(empty($listData)) { ?>
    <p class="text-center">Produk tidak ditemukan</p>
<?php } ?>
<?php foreach($listData as $row) { ?>

<div class="flex gap-4 mb-6 border-b pb-4 hover:bg-gray-50 transition p-2 rounded">
    <img src="uploads/<?= $row['gambar'] ?>" class="w-40 h-28 object-cover rounded-lg hover:scale-105 transition">
    <div class="flex-1">
        <h3 class="font-semibold text-lg">
            <?= $row['nama_produk'] ?>
        </h3>

        <p class="text-sm text-gray-500">
            <?= substr($row['deskripsi'], 0, 100) ?>...
        </p>

        <div class="flex items-center justify-between mt-2">

            <p class="text-green-600 font-bold">
                Rp <?= number_format($row['harga']) ?>
            </p>

            <a href="index.php?page=detail&id=<?= $row['id'] ?>" class="text-green-600 text-sm font-semibold">
               Detail →
            </a>
        </div>
    </div>
</div>
<?php } ?>

<!-- 🔢 PAGINATION -->
<div class="flex justify-center mt-8 space-x-2">
<?php for ($i = 1; $i <= $totalPage; $i++) { ?>
<a href="index.php?page=product&halaman=<?= $i ?>&kategori=<?= $kategori ?>" 
class="px-3 py-1 border rounded <?= ($i == $page) ? 'bg-green-600 text-white' : '' ?>">
   <?= $i ?>
</a>
<?php } ?>
</div><br><br>
<!-- TRAINING & MAP -->
<section>
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
</div>