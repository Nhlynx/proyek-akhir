<?php
$title = "Edit Artikel | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

// fungsi slug
function buatSlug($text) {
    $text = strtolower($text);
    $text = preg_replace('/[^a-z0-9]+/', '-', $text);
    return trim($text, '-');
}

// ambil id
$id = $_GET['id'];

// ambil data artikel
$data = mysqli_query($conn, "SELECT * FROM artikel WHERE id='$id'");
$row = mysqli_fetch_assoc($data);

// proses update
if (isset($_POST['submit'])) {

    $judul = $_POST['judul'];
    $isi = $_POST['isi'];
    $penulis = $_POST['penulis'];
    $slug = buatSlug($judul);

    // cek upload gambar
    if ($_FILES['gambar']['name'] != '') {

        $gambar = time() . '_' . $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];

        move_uploaded_file($tmp, "../../uploads/" . $gambar);

    } else {
        $gambar = $row['gambar'];
    }

    mysqli_query($conn, "UPDATE artikel SET judul='$judul', slug='$slug', isi='$isi', gambar='$gambar', penulis='$penulis'
        WHERE id='$id'");

    echo "<script> alert('Artikel berhasil diupdate!'); window.location='artikel.php'; </script>";
}
?>

<main class="flex-1 p-6">
    <!-- Header -->
    <div class="bg-white p-4 rounded-xl shadow mb-6">
        <h2 class="font-semibold text-lg">Edit Artikel</h2>
    </div>

    <!-- Form Tengah -->
    <div class="flex justify-center mt-6">
        <div class="bg-white p-6 rounded-xl shadow w-full max-w-3xl">

            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <!-- Judul -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Judul</label>
                    <input type="text" name="judul" required
                           value="<?= $row['judul']; ?>"
                           class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- Penulis -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Penulis</label>
                    <input type="text" name="penulis" value="<?= $row['penulis']; ?>" class="w-full border rounded-lg px-3 py-2">
                </div>

                <!-- Isi -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Isi Artikel</label>
                    <textarea name="isi" id="editor" class="w-full border rounded-lg px-3 py-2"><?= $row['isi']; ?></textarea>
                </div>

                <!-- Gambar -->
                <div>
                    <label class="block mb-1 text-sm font-medium">Gambar</label>
                    <?php if ($row['gambar']) : ?>
                        <img src="../../uploads/<?= $row['gambar']; ?>"
                             class="w-24 mb-2 rounded">
                    <?php endif; ?>
                    <input type="file" name="gambar" class="w-full border rounded-lg px-3 py-2 bg-white">
                </div>

                <!-- Tombol -->
                <div class="flex gap-3">
                    <button type="submit" name="submit" class="bg-[#3A59D1] text-white px-5 py-2 rounded-lg hover:bg-[#2f47a8]">
                        Update
                    </button>

                    <a href="artikel.php" class="bg-gray-300 px-5 py-2 rounded-lg hover:bg-gray-400">
                        Kembali
                    </a>
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