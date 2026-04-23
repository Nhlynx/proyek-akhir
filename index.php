<?php
include 'koneksi.php';
$page = $_GET['page'] ?? 'home';
$sub  = $_GET['sub'] ?? '';
$child = $_GET['child'] ?? '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rumah Koro</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

<?php include 'layout/navbar.php'; ?>

<div class="mt-6"></div>

<main>
<?php
switch ($page) {
    case 'tentang':
        if ($sub == 'profil') {
            include 'pages/about-us/profil.php';
        } elseif ($sub == 'visi') {
            include 'pages/about-us/visi.php';
        } elseif ($sub == 'sejarah') {
            include 'pages/about-us/sejarah.php';
        }
        else {
            include 'pages/about-us/index.php';
        }
        break;

    case 'produk':
        include 'pages/product/index.php';
        break;

    case 'detail_produk':
        include 'pages/product/detail.php';
        break;
    
    case 'detail_artikel':
        include 'pages/detail_artikel.php';
        break;

    case 'program':
        if ($sub == 'kemitraan') {
            include 'pages/program/kemitraan.php';
        } elseif ($sub == 'konsultan') {
            include 'pages/program/konsultan.php';
        } else {
            include 'pages/program/index.php';
        }
        break;

    case 'edukasi':
        if ($sub == 'narasumber') {
            include 'pages/edukasi/narasumber.php';
        } elseif ($sub == 'pelatihan') {
            include 'pages/edukasi/pelatihan.php';
        } else {
            include 'pages/edukasi/index.php';
        }
        break;

    default:
        include 'pages/home.php';
        break;
}
?>
</main>

</body>
</html>