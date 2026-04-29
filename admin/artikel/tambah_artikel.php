<?php
$title = "Tambah Artikel | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

// fungsi buat slug otomatis
function buatSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

if (isset($_POST['submit'])) {

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $slug = buatSlug($judul);

    // upload gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if ($gambar != '') {
        move_uploaded_file($tmp, "../../uploads/" . $gambar);
    }

    mysqli_query($conn, "INSERT INTO artikel (judul, slug, isi, gambar, penulis) VALUES ('$judul', '$slug', '$isi', '$gambar', '$penulis')");

    echo "<script> alert('Artikel berhasil ditambahkan!'); window.location='artikel.php'; </script>";
}
?>

<main class="flex-1 p-6">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl shadow mb-6">
        <h2 class="font-semibold text-lg">Tambah Artikel</h2>
    </div>

    <!-- Form Tengah -->
    <div class="flex justify-center mt-6">
        <div class="bg-white p-6 rounded-xl shadow w-full max-w-3xl">
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <!-- Judul -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Judul</label>
                    <input type="text" name="judul" required
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Penulis</label>
                    <input type="text" name="penulis" class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- Isi -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Isi Artikel</label>
                    <textarea name="isi" id="editor" class="w-full border rounded-lg px-3 py-2"></textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Gambar</label>
                    <input type="file" name="gambar" class="w-full border rounded-lg px-3 py-2 bg-white">
                </div>

                <!-- Tombol -->
                <div class="flex gap-3">
                    <button type="submit" name="submit" class="bg-[#3A59D1] text-white px-5 py-2 rounded-lg hover:bg-[#2f47a8]">
                        Simpan
                    </button>

                    <a href="artikel.php" class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</main>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });
</script>
<?php include '../../layout/admin/footer.php'; ?>