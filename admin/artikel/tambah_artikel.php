<?php
$title = "Tambah Artikel | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

function buatSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

if (isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $slug    = buatSlug($judul);

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    if ($gambar != '') {
        move_uploaded_file($tmp, "../../uploads/" . $gambar);
    }

    mysqli_query($conn, "INSERT INTO artikel (judul, slug, isi, gambar, penulis) VALUES ('$judul', '$slug', '$isi', '$gambar', '$penulis')");
    echo "<script> alert('Artikel berhasil ditambahkan!'); window.location='artikel.php'; </script>";
}
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Tambah Artikel</h2>
            <p class="text-gray-400 text-xs mt-0.5">Tulis dan publikasikan artikel baru</p>
        </div>
        <a href="artikel.php"
           class="inline-flex items-center gap-2 border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
            ← Kembali
        </a>
    </div>

    <form method="POST" enctype="multipart/form-data">
        <div class="grid md:grid-cols-3 gap-6">

            <!-- Kolom Kiri: Editor Utama -->
            <div class="md:col-span-2 space-y-5">

                <!-- Judul -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" required
                           placeholder="Masukkan judul artikel..."
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Isi Artikel -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Isi Artikel <span class="text-red-500">*</span>
                    </label>
                    <textarea name="isi" id="editor" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm"
                              placeholder="Tulis isi artikel di sini..."></textarea>
                </div>

            </div>

            <!-- Kolom Kanan: Meta -->
            <div class="space-y-5">

                <!-- Penulis -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Penulis</label>
                    <input type="text" name="penulis"
                           placeholder="Nama penulis..."
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Gambar -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Gambar Artikel</label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-[#0f5c5c] transition cursor-pointer"
                         onclick="document.getElementById('inputGambar').click()">
                        <div id="previewWrapper" class="hidden mb-3">
                            <img id="previewImg" src="#" alt="Preview"
                                 class="w-full h-36 object-cover rounded-xl border border-gray-100">
                        </div>
                        <div id="uploadPlaceholder">
                            <p class="text-3xl mb-2">🖼️</p>
                            <p class="text-sm text-gray-400">Klik untuk pilih gambar</p>
                            <p class="text-xs text-gray-300 mt-1">JPG, PNG, JPEG</p>
                        </div>
                        <input type="file" id="inputGambar" name="gambar" accept="image/*" class="hidden"
                               onchange="previewGambar(this)">
                    </div>
                    <p id="namaFile" class="text-xs text-gray-400 mt-1.5"></p>
                </div>

                <!-- Tombol Aksi -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-3">
                    <button type="submit" name="submit"
                            class="w-full bg-[#0f5c5c] text-white py-3 rounded-xl font-semibold text-sm hover:bg-[#0a4444] transition">
                        Publikasikan Artikel
                    </button>
                    <a href="artikel.php"
                       class="block w-full text-center border border-gray-200 text-gray-600 py-3 rounded-xl font-semibold text-sm hover:bg-gray-50 transition">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>

</main>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => { console.error(error); });

function previewGambar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('previewWrapper').classList.remove('hidden');
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('namaFile').textContent = '✔ ' + input.files[0].name;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

<?php include '../../layout/admin/footer.php'; ?>
