<aside class="w-64 bg-gradient-to-b from-[#03575d] to-[#0098a7] text-white p-5">
    <h2 class="text-2xl font-bold mb-6">Admin Panel</h2>
    <nav class="space-y-2">
        <a href="/proyek-akhir/admin/dashboard.php" class="block px-4 py-2 rounded-lg hover:bg-white/20 
           <?php if(basename($_SERVER['PHP_SELF']) == 'dashboard.php') echo 'bg-white/20'; ?>">Dashboard</a>

        <a href="/proyek-akhir/admin/produk/produk.php" class="block px-4 py-2 rounded-lg hover:bg-white/20 
           <?php if(basename($_SERVER['PHP_SELF']) == 'produk.php') echo 'bg-white/20'; ?>">Produk</a>

        <a href="/proyek-akhir/admin/artikel/artikel.php" class="block px-4 py-2 rounded-lg hover:bg-white/20 
           <?php if(basename($_SERVER['PHP_SELF']) == 'artikel.php') echo 'bg-white/20'; ?>">Artikel</a>

        <a href="/proyek-akhir/auth/logout.php" class="block px-4 py-2 rounded-lg hover:bg-red-500">Logout</a>
    </nav>
</aside>