<?php
session_start();
include 'koneksi.php';
$title = 'Rumah Koro';
$page = $_GET['page'] ?? 'home';
$sub  = $_GET['sub'] ?? '';

ob_start();

switch ($page) {
    case 'tentang':
        if ($sub == 'profil') {
            $title = "Profil Perusahaan";
            include 'pages/about-us/profil.php';
        } elseif ($sub == 'visi') {
            $title = "Visi & Misi";
            include 'pages/about-us/visimisi.php';
        } elseif ($sub == 'sejarah') {
            $title = "Sejarah Perusahaan";
            include 'pages/about-us/sejarah.php';
        } else {
            $title = "Tentang Kami";
            include 'pages/about-us/index.php';
        }
        break;

    case 'produk':
        $title = "Produk Kami";
        include 'pages/product/index.php';
        break;

    case 'detail_produk':
        $title = "Detail Produk";
        include 'pages/product/detail.php';
        break;

    case 'detail_artikel':
        $title = "Detail Artikel";
        include 'pages/detail_artikel.php';
        break;

    case 'program':
        if ($sub == 'kemitraan') {
            $title = "Program Kemitraan";
            include 'pages/program/kemitraan.php';
        } elseif ($sub == 'konsultan') {
            $title = "Program Konsultan";
            include 'pages/program/konsultan.php';
        } else {
            $title = "Program";
            include 'pages/program/index.php';
        }
        break;

    case 'edukasi':
        if ($sub == 'narasumber') {
            $title = "Narasumber";
            include 'pages/rumah-edukasi/narasumber.php';
        } elseif ($sub == 'pelatihan') {
            $title = "Pelatihan";
            include 'pages/rumah-edukasi/pelatihan.php';
        } else {
            $title = "Edukasi";
            include 'pages/rumah-edukasi/index.php';
        }
        break;

    case 'login':
        $title = "Login Admin";
        include 'auth/login.php';
        break;

    default:
        $title = "Home";
        include 'pages/home.php';
        break;
}
$content = ob_get_clean();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?> - Rumah Koro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

<?php if($page != 'login') { ?>
    <?php include 'layout/navbar.php'; ?>
<?php } ?>

<div class="mt-6"></div>

<main>
    <?= $content ?>
</main>

</body>
</html>