<?php
$title = "Data Artikel | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

// ambil data artikel terbaru
$data = mysqli_query($conn, "SELECT * FROM artikel ORDER BY created_at DESC");
?>

<main class="flex-1 p-6">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl shadow mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-lg">Data Artikel</h2>
        <a href="tambah_artikel.php" class="bg-[#03575d] text-white px-4 py-2 rounded-lg hover:bg-[#2f47a8]">+ Tambah Artikel</a>
    </div>

    <!-- Tabel -->
    <div class="bg-white p-6 rounded-xl shadow overflow-x-auto">
        <table class="w-full text-sm text-left border-collapse">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="p-3">No</th>
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Penulis</th>
                    <th class="p-3">Tanggal</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $no = 1; ?>
                <?php while($row = mysqli_fetch_assoc($data)) : ?>
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3"><?= $no++; ?></td>

                    <td class="p-3">
                        <?php if ($row['gambar']) : ?>
                            <img src="../../uploads/<?= $row['gambar']; ?>"
                                 class="w-16 h-16 object-cover rounded">
                        <?php else : ?>
                            <span class="text-gray-400">No Image</span>
                        <?php endif; ?>
                    </td>

                    <td class="p-3 font-medium">
                        <?= $row['judul']; ?>
                    </td>

                    <td class="p-3">
                        <?= $row['penulis']; ?>
                    </td>

                    <td class="p-3">
                        <?= date('d M Y', strtotime($row['created_at'])); ?>
                    </td>

                    <td class="p-3 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="edit_artikel.php?id=<?= $row['id']; ?>"class="bg-yellow-400 text-white px-3 py-1 rounded hover:bg-yellow-500">
                               Edit</a>
                            <a href="hapus_artikel.php?id=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus artikel ini?')"
                               class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include '../../layout/admin/footer.php'; ?>