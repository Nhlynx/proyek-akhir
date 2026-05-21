<?php
$title = "Tambah Produk | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

if (isset($_POST['submit'])) {
    $nama      = $_POST['nama_produk'];
    $kategori  = $_POST['kategori'];
    $deskripsi = $_POST['deskripsi'];
    $harga     = $_POST['harga'];
    $stok      = $_POST['stok'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "../../uploads/" . $gambar);

    mysqli_query($conn, "INSERT INTO produk (nama_produk, kategori, deskripsi, harga, stok, gambar) VALUES ('$nama', '$kategori', '$deskripsi', '$harga', '$stok', '$gambar')");
    header("Location: produk.php?notif=tambah");
    exit;
}
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Tambah Produk</h2>
            <p class="text-gray-400 text-xs mt-0.5">Isi form di bawah untuk menambahkan produk baru</p>
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
                <p class="text-white font-semibold text-sm">📦 Informasi Produk</p>
            </div>
            <form method="POST" enctype="multipart/form-data" class="p-6 space-y-5">

                <!-- Nama Produk -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Nama Produk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama_produk" required placeholder="Contoh: Tempe Koro Pedang"
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
                        <option value="produk-segar">Produk Segar</option>
                        <option value="camilan-sehat">Camilan Sehat</option>
                        <option value="bumbu-saus">Bumbu & Saus</option>
                    </select>
                </div>

                <!-- Deskripsi -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="4" placeholder="Tuliskan deskripsi produk..."
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition resize-none"></textarea>
                </div>

                <!-- Harga & Stok -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Harga (Rp) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="harga" required placeholder="0" min="0"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Stok <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="stok" required placeholder="0" min="0"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                    </div>
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Gambar Produk <span class="text-red-500">*</span>
                    </label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-[#0f5c5c] transition cursor-pointer"
                         onclick="document.getElementById('inputGambar').click()">
                        <div id="previewWrapper" class="hidden mb-3">
                            <img id="previewImg" src="#" alt="Preview" class="w-32 h-32 object-cover rounded-xl mx-auto border border-gray-100">
                        </div>
                        <div id="uploadPlaceholder">
                            <p class="text-3xl mb-2">🖼️</p>
                            <p class="text-sm text-gray-400">Klik untuk pilih gambar</p>
                            <p class="text-xs text-gray-300 mt-1">JPG, PNG, JPEG</p>
                        </div>
                        <input type="file" id="inputGambar" name="gambar" required accept="image/*" class="hidden"
                               onchange="previewGambar(this)">
                    </div>
                    <p id="namaFile" class="text-xs text-gray-400 mt-1.5"></p>
                </div>

                <!-- Tombol -->
                <div class="flex gap-3 pt-2">
                    <button type="submit" name="submit"
                            class="flex-1 bg-[#0f5c5c] text-white py-3 rounded-xl font-semibold text-sm hover:bg-[#0a4444] transition">
                        Simpan Produk
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
function previewGambar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewWrapper').classList.remove('hidden');
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('namaFile').textContent = input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include '../../layout/admin/footer.php'; ?>
