<?php
$title = "Tambah Produk | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

// proses simpan
if (isset($_POST['submit'])) {

    $nama   = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga  = $_POST['harga'];
    $stok = $_POST['stok'];

    // upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    move_uploaded_file($tmp, "../../uploads/" . $gambar);

    // insert ke database
    mysqli_query($conn, "INSERT INTO produk (nama_produk, kategori, deskripsi, harga, stok, gambar) VALUES ('$nama', '$kategori', '$deskripsi', '$harga', '$stok', '$gambar')");
    echo "<script> alert('Produk berhasil ditambahkan!'); window.location='produk.php'; </script>";
}
?>

<main class="flex-1 p-6">

    <!-- Header -->
    <div class="bg-white p-4 rounded-xl shadow mb-6">
        <h2 class="font-semibold text-lg">Tambah Produk</h2>
    </div>

    <!-- Form -->
    <div class="flex justify-center mt-10">
    <div class="bg-white p-6 rounded-xl shadow w-full max-w-2xl">
        <form method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block mb-1 text-sm font-medium">Nama Produk</label>
                <input type="text" name="nama_produk" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Kategori</label>
                <select name="kategori" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="produk-segar">Produk Segar</option>
                    <option value="camilan-sehat">Camilan Sehat</option>
                    <option value="bumbu-saus">Bumbu & Saus</option>
                </select>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"></textarea>
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Harga</label>
                <input type="number" name="harga" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>
            
            <div>
                <label class="block mb-1 text-sm font-medium">Stok</label>
                <input type="number" name="stok" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
            </div>

            <div>
                <label class="block mb-1 text-sm font-medium">Gambar</label>
                <input type="file" name="gambar" required class="w-full border rounded-lg px-3 py-2 bg-white">
            </div>

            <div class="flex gap-3">
                <button type="submit" name="submit" class="bg-[#3A59D1] text-white px-5 py-2 rounded-lg hover:bg-[#2f47a8]">
                    Submit</button>
                <a href="produk.php" class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
            </div>
        </form>
    </div>    
    </div>
</main>

<?php include '../../layout/admin/footer.php'; ?>