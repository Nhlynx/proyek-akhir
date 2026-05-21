<?php
$title = "Edit Artikel | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

function buatSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

$id   = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM artikel WHERE id='$id'");
$row  = mysqli_fetch_assoc($data);

if (isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $slug    = buatSlug($judul);

    if ($_FILES['gambar']['name'] != '') {
        $gambar = time() . '_' . $_FILES['gambar']['name'];
        $tmp    = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp, "../../uploads/" . $gambar);
    } else {
        $gambar = $row['gambar'];
    }

    mysqli_query($conn, "UPDATE artikel SET judul='$judul', slug='$slug', isi='$isi', gambar='$gambar', penulis='$penulis' WHERE id='$id'");
    header("Location: artikel.php?notif=edit");
    exit;
}
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Top Bar -->
    <div class="bg-white px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div>
            <h2 class="font-bold text-gray-800 text-lg">Edit Artikel</h2>
            <p class="text-gray-400 text-xs mt-0.5">Perbarui konten artikel</p>
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
                           value="<?= htmlspecialchars($row['judul']) ?>"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                    <p class="text-xs text-gray-400 mt-1.5">
                        Slug saat ini: <span class="font-mono text-[#0f5c5c]">/<?= htmlspecialchars($row['slug']) ?></span>
                        <span class="text-gray-300 ml-1">(otomatis diperbarui)</span>
                    </p>
                </div>

                <!-- Isi Artikel -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Isi Artikel <span class="text-red-500">*</span>
                    </label>
                    <textarea name="isi" id="editor"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm"><?= htmlspecialchars($row['isi']) ?></textarea>
                </div>

            </div>

            <!-- Kolom Kanan: Meta -->
            <div class="space-y-5">

                <!-- Penulis -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Penulis</label>
                    <input type="text" name="penulis"
                           value="<?= htmlspecialchars($row['penulis']) ?>"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Gambar -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Gambar Artikel</label>

                    <!-- Preview gambar saat ini -->
                    <?php if ($row['gambar']) : ?>
                    <div class="mb-3">
                        <img src="../../uploads/<?= htmlspecialchars($row['gambar']) ?>"
                             id="previewImg"
                             class="w-full h-36 object-cover rounded-xl border border-gray-100 mb-2">
                        <p class="text-xs text-gray-400">
                            📎 <?= htmlspecialchars($row['gambar']) ?>
                        </p>
                    </div>
                    <?php endif; ?>

                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-[#0f5c5c] transition cursor-pointer"
                         onclick="document.getElementById('inputGambar').click()">
                        <p class="text-sm text-gray-400">🖼️ Klik untuk ganti gambar</p>
                        <p class="text-xs text-gray-300 mt-1">Kosongkan jika tidak ingin mengganti</p>
                        <input type="file" id="inputGambar" name="gambar" accept="image/*" class="hidden"
                               onchange="gantiPreview(this)">
                    </div>
                    <p id="namaFile" class="text-xs text-gray-400 mt-1.5"></p>
                </div>

                <!-- Info Artikel -->
                <div class="bg-gray-50 rounded-2xl border border-gray-100 p-5">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-3">Info Artikel</p>
                    <div class="space-y-2">
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-400">Dibuat</span>
                            <span class="text-gray-600 font-medium"><?= date('d M Y', strtotime($row['created_at'])) ?></span>
                        </div>
                        <div class="flex justify-between text-xs">
                            <span class="text-gray-400">ID Artikel</span>
                            <span class="text-gray-600 font-mono">#<?= $row['id'] ?></span>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 space-y-3">
                    <button type="submit" name="submit"
                            class="w-full bg-[#0f5c5c] text-white py-3 rounded-xl font-semibold text-sm hover:bg-[#0a4444] transition">
                        Simpan Perubahan
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
