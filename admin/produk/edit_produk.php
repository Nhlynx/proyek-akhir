<?php
$title = "Edit Produk | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

$id   = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM produk WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $nama      = $_POST['nama_produk'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];
    $stok      = $_POST['stok'];

    if ($_FILES['gambar']['name'] != '') {
        $gambar = $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../../uploads/" . $gambar);
    } else {
        $gambar = $row['gambar'];
    }

    mysqli_query($conn, "UPDATE produk SET nama_produk='$nama', kategori='$kategori', deskripsi='$deskripsi', harga='$harga', stok='$stok', gambar='$gambar' WHERE id='$id'");
    header("Location: produk.php?notif=edit");
    exit;
}
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Edit Produk</h2>
            <p class="text-gray-400 text-xs mt-0.5">Perbarui informasi produk di bawah</p>
        </div>
        <a href="produk.php"
           class="inline-flex items-center gap-2 border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
            ← Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-[#0f5c5c] px-6 py-4">
                <p class="text-white font-semibold text-sm">✏️ Edit Informasi Produk</p>
            </div>
            <form method="POST" enctype="multipart/form-data" class="p-6 space-y-5">

                <!-- Nama Produk -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_produk" required
                           value="<?= htmlspecialchars($row['nama_produk']) ?>"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori" required
                            class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition bg-white">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="produk-segar"  <?= ($row['kategori'] == 'produk-segar')  ? 'selected' : '' ?>>Produk Segar</option>
                        <option value="camilan-sehat" <?= ($row['kategori'] == 'camilan-sehat') ? 'selected' : '' ?>>Camilan Sehat</option>
                        <option value="bumbu-saus"    <?= ($row['kategori'] == 'bumbu-saus')    ? 'selected' : '' ?>>Bumbu & Saus</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition resize-none"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                </div>

                <!-- Harga & Stok -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="harga" required min="0"
                               value="<?= htmlspecialchars($row['harga']) ?>"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" required min="0"
                               value="<?= htmlspecialchars($row['stok']) ?>"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                    </div>
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Gambar Produk</label>

                    <!-- Preview gambar saat ini -->
                    <?php if ($row['gambar']) : ?>
                    <div class="flex items-center gap-4 bg-gray-50 rounded-xl p-4 mb-3 border border-gray-100">
                        <img src="../../uploads/<?= htmlspecialchars($row['gambar']) ?>"
                             id="previewImg"
                             class="w-20 h-20 object-cover rounded-xl border border-gray-200">
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Gambar Saat Ini</p>
                            <p class="text-xs text-gray-400 mt-0.5"><?= htmlspecialchars($row['gambar']) ?></p>
                            <p class="text-xs text-gray-400 mt-1">Pilih file baru untuk mengganti gambar</p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-[#0f5c5c] transition cursor-pointer"
                         onclick="document.getElementById('inputGambar').click()">
                        <p class="text-sm text-gray-400">🖼️ Klik untuk pilih gambar baru</p>
                        <p class="text-xs text-gray-300 mt-1">JPG, PNG, JPEG — kosongkan jika tidak ingin mengganti</p>
                        <input type="file" id="inputGambar" name="gambar" accept="image/*" class="hidden"
                               onchange="gantiPreview(this)">
                    </div>
                    <p id="namaFile" class="text-xs text-gray-400 mt-1.5"></p>
                </div>

                <!-- Tombol -->
                <div class="flex gap-3 pt-2">
                    <button type="submit" name="submit"
                            class="flex-1 bg-[#0f5c5c] text-white py-3 rounded-xl font-semibold text-sm hover:bg-[#0a4444] transition">
                        Simpan Perubahan
                    </button>
                    <a href="produk.php"
                       class="flex-1 text-center border border-gray-200 text-gray-600 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

</main>

<script>
function gantiPreview(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.getElementById('previewImg');
            if (img) img.src = e.target.result;
            document.getElementById('namaFile').textContent = '✔ ' + input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include '../../layout/admin/footer.php'; ?>
