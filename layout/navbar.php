<?php
include 'koneksi.php';
$currentPage = $_GET['page'] ?? 'home';
$sub         = $_GET['sub'] ?? null;

function isActive($page, $currentPage) {
    return $page === $currentPage;
}
?>

<nav id="navbar" class="bg-[#0f5c5c]/95 backdrop-blur-md max-w-5xl mx-auto mt-4 rounded-2xl shadow-xl sticky top-4 z-50 transition-all duration-300">
    <div class="mx-auto px-6 py-3 flex items-center justify-between">

        <!-- Logo -->
        <a href="index.php" class="flex items-center">
            <img src="/proyek-akhir/assets/RPN_logo.png" alt="Logo" class="h-12 ml-2 hover:opacity-90 transition duration-200">
        </a>

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center space-x-1 text-white font-medium text-sm">

            <!-- HOME -->
            <a href="index.php?page=home"
               class="relative px-4 py-2 rounded-xl transition-all duration-200
                      <?= isActive('home', $currentPage) ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' ?>">
                HOME
                <?php if (isActive('home', $currentPage)) : ?>
                <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-white rounded-full"></span>
                <?php endif; ?>
            </a>

            <!-- ABOUT US -->
            <div class="relative" id="dd-tentang"
                 onmouseenter="openDropdown('tentang')" onmouseleave="scheduleClose('tentang')">
                <a href="index.php?page=tentang"
                   class="relative flex items-center gap-1 px-4 py-2 rounded-xl transition-all duration-200
                          <?= isActive('tentang', $currentPage) ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' ?>">
                    ABOUT US
                    <svg class="w-3.5 h-3.5 transition-transform duration-200" id="arrow-tentang" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                    <?php if (isActive('tentang', $currentPage)) : ?>
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-white rounded-full"></span>
                    <?php endif; ?>
                </a>
                <div id="menu-tentang"
                     class="absolute top-full left-0 pt-2 hidden"
                     onmouseenter="cancelClose('tentang')" onmouseleave="scheduleClose('tentang')">
                    <div class="bg-white text-gray-700 rounded-xl shadow-xl w-44 overflow-hidden">
                        <a href="index.php?page=tentang&sub=profil"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'profil' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>👤</span> Profil
                        </a>
                        <a href="index.php?page=tentang&sub=sejarah"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'sejarah' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>📜</span> Sejarah
                        </a>
                        <a href="index.php?page=tentang&sub=visi"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'visi' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>🎯</span> Visi & Misi
                        </a>
                    </div>
                </div>
            </div>

            <!-- PRODUCT -->
            <div class="relative" id="dd-produk"
                 onmouseenter="openDropdown('produk')" onmouseleave="scheduleClose('produk')">
                <a href="index.php?page=produk"
                   class="relative flex items-center gap-1 px-4 py-2 rounded-xl transition-all duration-200
                          <?= isActive('produk', $currentPage) ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' ?>">
                    PRODUCT
                    <svg class="w-3.5 h-3.5 transition-transform duration-200" id="arrow-produk" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                    <?php if (isActive('produk', $currentPage)) : ?>
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-white rounded-full"></span>
                    <?php endif; ?>
                </a>
                <div id="menu-produk"
                     class="absolute top-full left-0 pt-2 hidden"
                     onmouseenter="cancelClose('produk')" onmouseleave="scheduleClose('produk')">
                    <div class="bg-white text-gray-700 rounded-xl shadow-xl w-52 overflow-hidden">
                        <a href="index.php?page=produk"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= (isActive('produk', $currentPage) && !isset($_GET['kategori'])) ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>📦</span> Semua Produk
                        </a>
                        <?php
                        $kategoriQuery2 = mysqli_query($conn, "SELECT DISTINCT kategori FROM produk");
                        while ($kat = mysqli_fetch_assoc($kategoriQuery2)) : ?>
                        <a href="index.php?page=produk&kategori=<?= urlencode($kat['kategori']) ?>"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= (isset($_GET['kategori']) && $_GET['kategori'] == $kat['kategori']) ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>🌿</span> <?= htmlspecialchars(ucfirst(str_replace('-', ' ', $kat['kategori']))) ?>
                        </a>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

            <!-- PROGRAM -->
            <div class="relative" id="dd-program"
                 onmouseenter="openDropdown('program')" onmouseleave="scheduleClose('program')">
                <a href="index.php?page=program"
                   class="relative flex items-center gap-1 px-4 py-2 rounded-xl transition-all duration-200
                          <?= isActive('program', $currentPage) ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' ?>">
                    PROGRAM
                    <svg class="w-3.5 h-3.5 transition-transform duration-200" id="arrow-program" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                    <?php if (isActive('program', $currentPage)) : ?>
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-white rounded-full"></span>
                    <?php endif; ?>
                </a>
                <div id="menu-program"
                     class="absolute top-full left-0 pt-2 hidden"
                     onmouseenter="cancelClose('program')" onmouseleave="scheduleClose('program')">
                    <div class="bg-white text-gray-700 rounded-xl shadow-xl w-44 overflow-hidden">
                        <a href="index.php?page=program&sub=kemitraan"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'kemitraan' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>🤝</span> Kemitraan
                        </a>
                        <a href="index.php?page=program&sub=konsultan"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'konsultan' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>💼</span> Konsultan
                        </a>
                    </div>
                </div>
            </div>

            <!-- RUMAH EDUKASI -->
            <div class="relative" id="dd-edukasi"
                 onmouseenter="openDropdown('edukasi')" onmouseleave="scheduleClose('edukasi')">
                <a href="index.php?page=edukasi"
                   class="relative flex items-center gap-1 px-4 py-2 rounded-xl transition-all duration-200
                          <?= isActive('edukasi', $currentPage) ? 'bg-white/20 text-white' : 'text-white/80 hover:bg-white/10 hover:text-white' ?>">
                    RUMAH EDUKASI
                    <svg class="w-3.5 h-3.5 transition-transform duration-200" id="arrow-edukasi" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/>
                    </svg>
                    <?php if (isActive('edukasi', $currentPage)) : ?>
                    <span class="absolute bottom-1 left-1/2 -translate-x-1/2 w-1 h-1 bg-white rounded-full"></span>
                    <?php endif; ?>
                </a>
                <div id="menu-edukasi"
                     class="absolute top-full left-0 pt-2 hidden"
                     onmouseenter="cancelClose('edukasi')" onmouseleave="scheduleClose('edukasi')">
                    <div class="bg-white text-gray-700 rounded-xl shadow-xl w-44 overflow-hidden">
                        <a href="index.php?page=edukasi&sub=narasumber"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'narasumber' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>🎤</span> Narasumber
                        </a>
                        <a href="index.php?page=edukasi&sub=pelatihan"
                           class="flex items-center gap-2 px-4 py-2.5 text-sm hover:bg-[#0f5c5c]/10 hover:text-[#0f5c5c] transition
                                  <?= $sub == 'pelatihan' ? 'bg-[#0f5c5c]/10 text-[#0f5c5c] font-semibold' : '' ?>">
                            <span>📚</span> Pelatihan
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- Admin Login -->
        <div class="hidden md:flex items-center">
            <a href="index.php?page=login"
               class="bg-orange-500 text-white px-5 py-2 rounded-full font-semibold text-sm shadow-md
                      hover:bg-orange-600 hover:scale-105 transition duration-200">
                Admin Login
            </a>
        </div>

        <!-- Mobile Hamburger -->
        <button id="menuToggle" class="md:hidden text-white p-2 rounded-xl hover:bg-white/10 transition" onclick="toggleMenu()">
            <svg id="iconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="iconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden px-4 pb-4 space-y-1 border-t border-white/10 pt-3">
        <a href="index.php?page=home"
           class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                  <?= isActive('home', $currentPage) ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            🏠 Home
        </a>
        <a href="index.php?page=tentang"
           class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                  <?= isActive('tentang', $currentPage) ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            👥 About Us
        </a>
        <a href="index.php?page=produk"
           class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                  <?= isActive('produk', $currentPage) ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            📦 Product
        </a>
        <a href="index.php?page=program"
           class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                  <?= isActive('program', $currentPage) ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            🤝 Program
        </a>
        <a href="index.php?page=edukasi"
           class="block px-4 py-2.5 rounded-xl text-sm font-medium transition
                  <?= isActive('edukasi', $currentPage) ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            📚 Rumah Edukasi
        </a>
        <div class="pt-2 border-t border-white/10">
            <a href="index.php?page=login"
               class="block px-4 py-2.5 rounded-xl text-sm font-medium bg-orange-500 text-white text-center hover:bg-orange-600 transition">
                Admin Login
            </a>
        </div>
    </div>
</nav>

<script>
// Dropdown dengan delay close agar tidak langsung tutup
const closeTimers = {};

function openDropdown(id) {
    clearTimeout(closeTimers[id]);
    const menu  = document.getElementById('menu-' + id);
    const arrow = document.getElementById('arrow-' + id);
    if (menu)  menu.classList.remove('hidden');
    if (arrow) arrow.style.transform = 'rotate(180deg)';
}

function scheduleClose(id) {
    closeTimers[id] = setTimeout(function () {
        const menu  = document.getElementById('menu-' + id);
        const arrow = document.getElementById('arrow-' + id);
        if (menu)  menu.classList.add('hidden');
        if (arrow) arrow.style.transform = 'rotate(0deg)';
    }, 150); // 150ms delay — cukup untuk pindah ke dropdown
}

function cancelClose(id) {
    clearTimeout(closeTimers[id]);
}

// Scroll effect
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('shadow-2xl', 'scale-[0.98]');
    } else {
        navbar.classList.remove('shadow-2xl', 'scale-[0.98]');
    }
});

// Mobile toggle
function toggleMenu() {
    const menu      = document.getElementById('mobileMenu');
    const iconOpen  = document.getElementById('iconOpen');
    const iconClose = document.getElementById('iconClose');
    menu.classList.toggle('hidden');
    iconOpen.classList.toggle('hidden');
    iconClose.classList.toggle('hidden');
}
</script>
