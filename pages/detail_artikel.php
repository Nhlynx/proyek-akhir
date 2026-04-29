<?php
$slug = $_GET['slug'] ?? '';
$query = mysqli_query($conn, "SELECT * FROM artikel WHERE slug = '$slug'");
$related = mysqli_query($conn, "SELECT * FROM artikel WHERE slug != '$slug' LIMIT 3");
$data = mysqli_fetch_assoc($query);
if(!$data){
    echo "<h1>Artikel tidak ditemukan</h1>";
    exit;
}
?>

<div class="bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto bg-white p-6 md:p-10 rounded-xl shadow">
        <!-- BACK -->
        <a href="index.php" class="text-green-600 hover:underline text-sm mb-6 inline-block">
            ← Kembali ke Beranda
        </a>

        <!-- JUDUL -->
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4 leading-tight">
            <?= $data['judul']; ?>
        </h1>

        <!-- META -->
        <div class="text-sm text-gray-500 mb-6"> Ditulis oleh <span class="font-medium"><?= $data['penulis']; ?></span>
            • <?= date('d F Y', strtotime($data['created_at'])); ?>
        </div>

        <!-- GAMBAR -->
        <img src="/proyek-akhir/uploads/<?= $data['gambar']; ?>" class="w-full rounded-xl mb-8 shadow">
        <!-- ISI -->
        <div class="text-gray-700 leading-relaxed space-y-4 text-justify">
            <?= nl2br($data['isi']); ?>
        </div>
    </div>
</div>

<div class="max-w-4xl mx-auto mt-10">
    <h2 class="text-xl font-semibold mb-4">Artikel Lainnya</h2>

    <div class="grid md:grid-cols-3 gap-4">
        <?php while($r = mysqli_fetch_assoc($related)) { ?>
            <a href="index.php?page=detail_artikel&slug=<?= $r['slug']; ?>" 
               class="block border p-3 rounded hover:shadow">

                <img src="/proyek-akhir/uploads/<?= $r['gambar']; ?>" 
                     class="rounded mb-2">

                <p class="text-sm font-medium">
                    <?= $r['judul']; ?>
                </p>

            </a>
        <?php } ?>
    </div>
</div>