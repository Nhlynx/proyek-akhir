<?php
$title = "Data Produk | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

// ambil data produk
$query = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
?>

<main class="flex-1 p-6">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl shadow mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-lg">Data Produk</h2>
        <a href="tambah_produk.php" class="bg-[#03575d] text-white px-4 py-2 rounded-lg hover:bg-[#2f47a8] transition">+ Tambah Produk</a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Gambar</th>
                    <th class="px-6 py-3">Nama Produk</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Harga</th>
                    <th class="px-6 py-3">Stok</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                <?php $no = 1; ?>
                <?php while($row = mysqli_fetch_assoc($query)) : ?>

                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-3"><?= $no++; ?></td>
                    <td class="px-6 py-3">
                        <img src="../../uploads/<?= $row['gambar']; ?>" class="w-16 h-16 object-cover rounded">
                    </td>

                    <td class="px-6 py-3"><?= $row['nama_produk']; ?></td>

                    <td class="px-6 py-3"><?= ucfirst(str_replace('-', ' ', $row['kategori'])) ?></td>

                    <td class="px-6 py-3">
                        Rp <?= number_format($row['harga'], 0, ',', '.'); ?>
                    </td>

                    <td class="px-6 py-3"><?= $row['stok']; ?></td>

                    <td class="px-6 py-3 space-x-2">

                        <a href="edit_produk.php?id=<?= $row['id']; ?>" 
                           class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">Edit</a>

                        <a href="hapus_produk.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus?')"
                           class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include '../../layout/admin/footer.php'; ?>