<!-- Overlay Mobile -->
<div id="sidebarOverlay"
     class="fixed inset-0 bg-black/50 z-30 hidden md:hidden"
     onclick="toggleSidebar()"></div>

<!-- Sidebar -->
<aside id="sidebar"
       class="fixed md:relative z-40 md:z-auto
              -translate-x-full md:translate-x-0
              transition-transform duration-300
              w-64 bg-[#0f5c5c] text-white flex flex-col min-h-screen">

    <!-- Logo / Brand -->
    <div class="px-6 py-6 border-b border-white/10 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 bg-white/20 rounded-xl flex items-center justify-center font-bold text-white text-sm flex-shrink-0">
                RK
            </div>
            <div>
                <p class="font-bold text-white text-sm leading-tight">Rumah Koro</p>
                <p class="text-white/50 text-xs">Admin Panel</p>
            </div>
        </div>
        <!-- Tombol tutup (mobile only) -->
        <button onclick="toggleSidebar()" class="md:hidden text-white/60 hover:text-white text-xl leading-none">×</button>
    </div>

    <!-- Navigasi -->
    <nav class="flex-1 px-4 py-5 space-y-1">

        <p class="text-white/40 text-xs font-semibold uppercase tracking-widest px-3 mb-3">Menu</p>

        <a href="/proyek-akhir/admin/dashboard.php"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                  <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            <span class="text-base">🏠</span>
            Dashboard
        </a>

        <a href="/proyek-akhir/admin/produk/produk.php"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                  <?= basename($_SERVER['PHP_SELF']) == 'produk.php' ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            <span class="text-base">📦</span>
            Produk
        </a>

        <a href="/proyek-akhir/admin/artikel/artikel.php"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                  <?= basename($_SERVER['PHP_SELF']) == 'artikel.php' ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            <span class="text-base">📝</span>
            Artikel
        </a>

        <a href="/proyek-akhir/admin/users/users.php"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                  <?= in_array(basename($_SERVER['PHP_SELF']), ['users.php', 'tambah_user.php', 'edit_user.php']) ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
            <span class="text-base">👥</span>
            Kelola Admin
        </a>

        <div class="pt-4">
            <p class="text-white/40 text-xs font-semibold uppercase tracking-widest px-3 mb-3">Lainnya</p>
            <a href="/proyek-akhir/admin/ubah_password.php"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition mb-1
                      <?= basename($_SERVER['PHP_SELF']) == 'ubah_password.php' ? 'bg-white/20 text-white' : 'text-white/70 hover:bg-white/10 hover:text-white' ?>">
                <span class="text-base">🔑</span>
                Ubah Password
            </a>
            <a href="/proyek-akhir/index.php" target="_blank"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition">
                <span class="text-base">🌐</span>
                Lihat Website
            </a>
        </div>

    </nav>

    <!-- Logout -->
    <div class="px-4 py-5 border-t border-white/10">
        <a href="/proyek-akhir/auth/logout.php"
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-white/70 hover:bg-red-500/30 hover:text-white transition w-full">
            <span class="text-base">🚪</span>
            Logout
        </a>
    </div>

</aside>

<script>
function toggleSidebar() {
    const sidebar  = document.getElementById('sidebar');
    const overlay  = document.getElementById('sidebarOverlay');
    const isOpen   = !sidebar.classList.contains('-translate-x-full');

    if (isOpen) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    } else {
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
    }
}
</script>
