<?php
$id = $_GET['id'] ?? 0;
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id = '$id'");
$produk = mysqli_fetch_assoc($query);

// produk terkait (random selain produk ini)
$related = mysqli_query($conn, "SELECT * FROM produk WHERE id != '$id' LIMIT 3");
?>

<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="grid md:grid-cols-2 gap-10">
        <!-- GAMBAR -->
        <div>
            <img src="uploads/<?= $produk['gambar'] ?>" class="rounded-xl shadow-lg w-full hover:scale-105 transition duration-300">
        </div>

        <!-- INFO -->
        <div>
            <h1 class="text-3xl font-bold mb-3">
                <?= $produk['nama_produk'] ?>
            </h1>

            <!-- Harga -->
            <div class="text-2xl font-semibold text-green-600 mb-3">
                Rp<?= number_format($produk['harga']) ?>
            </div>

            <!-- Stok -->
            <div class="mb-4">
                <?php if($produk['stok'] > 0) { ?>
                    <span class="text-green-600 font-medium">
                        ✔ Stok tersedia (<?= $produk['stok'] ?>)
                    </span>
                <?php } else { ?>
                    <span class="text-red-500 font-medium">
                        ✖ Stok habis
                    </span>
                <?php } ?>
            </div>

            <!-- Kategori -->
            <div class="text-sm text-gray-500 mb-6">
                Kategori: <?= $produk['kategori'] ?>
            </div>

            <!-- Tombol WA -->
            <?php
            $no_wa = "6285817800307";
            $pesan = "Halo admin, saya tertarik dengan produk:\n\n"
                    . "Nama: " . $produk['nama_produk'] . "\n"
                    . "Harga: Rp" . number_format($produk['harga']) . "\n"
                    . "Stok: " . $produk['stok'] . "\n\n"
                    . "Apakah masih tersedia?";
            $link_wa = "https://wa.me/$no_wa?text=" . urlencode($pesan);
            ?>

            <a href="<?= $link_wa ?>" target="_blank" class="inline-block bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md transition">
               💬 Pesan via WhatsApp
            </a>

        </div>
    </div>

    <!-- DESKRIPSI -->
    <div class="mt-12">
        <h2 class="text-xl font-semibold mb-3">Deskripsi Produk</h2>
        <p class="text-gray-700 leading-relaxed">
            <?= $produk['deskripsi'] ?>
        </p>
    </div>

    <!-- PRODUK TERKAIT -->
    <div class="mt-12">
        <h2 class="text-xl font-semibold mb-5">Produk Terkait</h2>
        <div class="grid md:grid-cols-3 gap-6">
            <?php while($r = mysqli_fetch_assoc($related)) { ?>
                <div class="border rounded-xl p-4 hover:shadow-lg transition">
                    <img src="uploads/<?= $r['gambar'] ?>" class="rounded mb-3">
                    <h3 class="font-semibold"><?= $r['nama_produk'] ?></h3>
                    <p class="text-green-600 font-bold">
                        Rp<?= number_format($r['harga']) ?>
                    </p>

                    <a href="index.php?page=detail_produk&id=<?= $r['id'] ?>" class="text-sm text-blue-500 hover:underline mt-2 inline-block">
                        Lihat Detail
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>