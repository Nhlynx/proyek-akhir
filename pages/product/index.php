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
</div>
</div>