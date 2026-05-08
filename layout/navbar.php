<?php
include 'koneksi.php';
$currentPage = $_GET['page'] ?? 'home';
$sub  = $_GET['sub'] ?? null;
$kategoriQuery = mysqli_query($conn, "SELECT DISTINCT kategori FROM produk");
?>

<nav class="bg-[#0f5c5c]/95 backdrop-blur-md max-w-5xl mx-auto mt-4 rounded-2xl shadow-xl sticky top-4 z-50 transition-all duration-300">
    <div class="max-w-7xl rounded-full mx-auto px-6 py-3 flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center">
            <img src="assets/RPN_logo.png" alt="Logo" class="h-12 ml-2">
        </div>

        <!-- Menu -->
        <div class="hidden md:flex items-center space-x-8 text-white font-medium">
            <a href="index.php?page=home" class="hover:text-gray-200 border-b-2 border-white pb-1 <?= $currentPage == 'home' ? 'border-white text-white' : 'border-transparent' ?>">
                HOME</a>
            <!-- ABOUT -->
            <div class="relative group">
                <a href="index.php?page=tentang" class="flex items-center gap-1 hover:text-gray-200 <?= $currentPage == 'tentang' ? 'border-white text-white' : 'border-transparent' ?>">
                ABOUT US ▾</a>
                <div class="absolute top-full left-0 hidden group-hover:block bg-white text-black rounded shadow-lg w-40">
                    <a href="index.php?page=tentang&sub=profil" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'profil' ? 'bg-gray-200' : '' ?> block px-4 py-2">Profil</a>
                    <a href="index.php?page=tentang&sub=sejarah" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'sejarah' ? 'bg-gray-200' : '' ?> block px-4 py-2">Sejarah</a>
                    <a href="index.php?page=tentang&sub=visi" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'visi' ? 'bg-gray-200' : '' ?> block px-4 py-2">Visi & Misi</a>
                </div>
            </div>

            <!-- PRODUCT -->
            <div class="relative group">
            <a href="index.php?page=produk" class="flex items-center gap-1 hover:text-gray-200 <?= $currentPage == 'produk' ? 'border-white text-white' : 'border-transparent' ?>">PRODUCT ▾</a>
            <div class="absolute top-full left-0 hidden group-hover:block bg-white text-black rounded shadow-lg w-56">
            <ul class="dropdown-menu">
            <?php while($kat = mysqli_fetch_assoc($kategoriQuery)) { ?>
            <li>
                <a href="index.php?page=produk&kategori=<?= $kat['kategori'] ?>" class="block px-4 py-2 hover:bg-gray-100">
                    <?= ucfirst(str_replace('-', ' ', $kat['kategori'])) ?>
                </a>
            </li>
            <?php } ?>
            </ul>
            </div>
            </div>

            <!-- PROGRAM -->
            <div class="relative group">
                <a href="index.php?page=program" class="flex items-center gap-1 hover:text-gray-200 <?= $currentPage == 'program' ? 'border-white text-white' : 'border-transparent' ?>">
                    PROGRAM ▾</a>
                <div class="absolute top-full left-0 hidden group-hover:block bg-white text-black rounded shadow-lg w-40">
                    <a href="index.php?page=program&sub=kemitraan" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'kemitraan' ? 'bg-gray-200' : '' ?> block px-4 py-2">Kemitraan</a>
                    <a href="index.php?page=program&sub=konsultan" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'konsultan' ? 'bg-gray-200' : '' ?> block px-4 py-2">Konsultan</a>
                </div>
            </div>

            <!-- EDUKASI -->
            <div class="relative group">
                <a href="index.php?page=edukasi" class="flex items-center gap-1 hover:text-gray-200 <?= $currentPage == 'edukasi' ? 'border-white text-white' : 'border-transparent' ?>">
                    RUMAH EDUKASI ▾</a>
                <div class="absolute top-full left-0 hidden group-hover:block bg-white text-black rounded shadow-lg w-48">
                    <a href="index.php?page=edukasi&sub=narasumber" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'narasumber' ? 'bg-gray-200' : '' ?> block px-4 py-2">Narasumber</a>
                    <a href="index.php?page=edukasi&sub=pelatihan" class="block px-4 py-2 hover:bg-gray-100 <?= $sub == 'pelatihan' ? 'bg-gray-200' : '' ?> block px-4 py-2">Pelatihan</a>
                </div>
            </div>
        </div>

        <!-- Right Icons -->
        <div class="hidden md:flex items-center space-x-3">
           <a href="index.php?page=login" class="bg-orange-500 text-white px-6 py-2.5 rounded-full font-semibold text-sm shadow-md hover:bg-orange-600 hover:scale-105 transition duration-200">
            Admin Login</a>
        </div>
    </div>
<script>
window.addEventListener("scroll", function() {
    const navbar = document.getElementById("navbar");

    if (window.scrollY > 50) {
        navbar.classList.add("shadow-2xl", "scale-[0.98]");
    } else {
        navbar.classList.remove("shadow-2xl", "scale-[0.98]");
    }
});
</script>
</nav>