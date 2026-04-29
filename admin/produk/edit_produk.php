<?php
$title = "Edit Produk | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

// ambil id dari URL
$id = $_GET['id'];

// ambil data produk
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// proses update
if (isset($_POST['submit'])) {

    $nama = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // cek apakah upload gambar baru
    if ($_FILES['gambar']['name'] != '') {

        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../../uploads/" . $gambar);

    } else {
        $gambar = $row['gambar'];
    }

    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', kategori='$kategori', deskripsi='$deskripsi', harga='$harga', stok='$stok', gambar='$gambar'
        WHERE id='$id'");

    echo "<script> alert('Produk berhasil diupdate!'); window.location='produk.php'; </script>";
}
?>

<main class="flex-1 p-6">
    <div class="bg-white p-4 rounded-xl shadow mb-6">
        <h2 class="font-semibold text-lg">Edit Produk</h2>
    </div>

    <div class="flex justify-center mt-6">
        <div class="bg-white p-6 rounded-xl shadow w-full max-w-2xl">
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block mb-1 text-sm font-medium">Nama Produk</label>
                    <input type="text" name="nama_produk" required value="<?= $row['nama_produk']; ?>" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Kategori</label>
                    <select name="kategori" required class="w-full border rounded-lg px-3 py-2">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="produk-segar" <?= ($row['kategori'] == 'produk-segar') ? 'selected' : ''; ?>>Produk Segar</option>
                        <option value="camilan-sehat" <?= ($row['kategori'] == 'camilan-sehat') ? 'selected' : ''; ?>>Camilan Sehat</option>
                        <option value="bumbu-saus" <?= ($row['kategori'] == 'bumbu-saus') ? 'selected' : ''; ?>>Bumbu & Saus</option>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" class="w-full border rounded-lg px-3 py-2"><?= $row['deskripsi']; ?></textarea>
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Harga</label>
                    <input type="number" name="harga" required value="<?= $row['harga']; ?>" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Stok</label>
                    <input type="number" name="stok" required value="<?= $row['stok']; ?>" class="w-full border rounded-lg px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 text-sm font-medium">Gambar</label>
                    <img src="../uploads/<?= $row['gambar']; ?>" class="w-24 mb-2 rounded">
                    <input type="file" name="gambar" class="w-full border rounded-lg px-3 py-2 bg-white">
                </div>

                <?php if ($row['gambar']) : ?>
                <div class="mb-3">
                    <label class="block mb-1">Gambar Saat Ini</label>
                    <img src="../../uploads/<?= $row['gambar']; ?>" class="w-32 h-32 object-cover rounded-lg border">
                    <p class="text-sm text-gray-500">Kosongkan jika tidak ingin mengganti gambar</p>
                </div>
                <?php endif; ?>

                <div class="flex gap-3">
                    <button type="submit" name="submit" class="bg-[#3A59D1] text-white px-5 py-2 rounded-lg hover:bg-[#2f47a8]">
                        Update</button>
                    <a href="produk.php" class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>
<?php include '../../layout/admin/footer.php'; ?>