<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../auth/login.php");
    exit;
}
$title = "Kelola Admin | Admin Panel";
include '../../koneksi.php';
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';

$query = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
$totalUsers = mysqli_num_rows($query);
?>

<main class="flex-1 p-6 overflow-y-auto">

    <!-- Toast Notifikasi -->
    <?php if (isset($_GET['notif'])) : ?>
    <?php
        $notifMap = [
            'tambah' => ['bg' => 'bg-green-500',  'icon' => '✅', 'msg' => 'Admin baru berhasil ditambahkan!'],
            'hapus'  => ['bg' => 'bg-red-500',    'icon' => '🗑️', 'msg' => 'Admin berhasil dihapus!'],
            'gagal_hapus_diri_sendiri' => ['bg' => 'bg-orange-500', 'icon' => '⚠️', 'msg' => 'Anda tidak bisa menghapus akun Anda sendiri!'],
            'error'  => ['bg' => 'bg-red-500',    'icon' => '❌', 'msg' => 'Terjadi kesalahan!'],
        ];
        $n = $notifMap[$_GET['notif']] ?? null;
    ?>
    <?php if ($n) : ?>
    <div id="toast"
         class="fixed top-6 right-6 z-50 flex items-center gap-3 <?= $n['bg'] ?> text-white px-5 py-3.5 rounded-2xl shadow-xl text-sm font-semibold transition-all duration-500">
        <span><?= $n['icon'] ?></span>
        <span><?= $n['msg'] ?></span>
        <button onclick="document.getElementById('toast').remove()" class="ml-2 text-white/70 hover:text-white text-lg leading-none">×</button>
    </div>
    <script>
        setTimeout(function() {
            const t = document.getElementById('toast');
            if (t) { t.style.opacity = '0'; t.style.transform = 'translateY(-10px)'; setTimeout(() => t.remove(), 500); }
        }, 3500);
    </script>
    <?php endif; ?>
    <?php endif; ?>

    <!-- Top Bar -->
    <div class="bg-white px-4 md:px-6 py-4 rounded-2xl shadow-sm mb-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()"
                    class="md:hidden w-9 h-9 flex items-center justify-center rounded-xl bg-gray-100 hover:bg-gray-200 transition text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
            <div>
                <h2 class="font-bold text-gray-800 text-lg">Kelola Admin</h2>
                <p class="text-gray-400 text-xs mt-0.5"><?= $totalUsers ?> admin terdaftar</p>
            </div>
        </div>
        <a href="tambah_user.php"
           class="inline-flex items-center gap-1 md:gap-2 bg-[#0f5c5c] text-white px-3 md:px-5 py-2.5 rounded-xl text-sm font-semibold hover:bg-[#0a4444] transition shadow-sm">
            <span>+</span><span class="hidden sm:inline">Tambah Admin</span>
        </a>
    </div>

    <!-- Tabel (desktop) -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hidden md:block">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest w-20">No</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest">Username</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest w-40">Status</th>
                        <th class="px-5 py-3 text-xs font-semibold text-gray-400 uppercase tracking-widest w-48">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php $no = 1; ?>
                    <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-5 py-4 text-gray-400 text-xs"><?= $no++ ?></td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-[#0f5c5c]/10 text-[#0f5c5c] rounded-full flex items-center justify-center font-bold text-sm">
                                    <?= strtoupper(substr($row['username'], 0, 1)) ?>
                                </div>
                                <p class="font-semibold text-gray-800"><?= htmlspecialchars($row['username']) ?></p>
                            </div>
                        </td>
                        <td class="px-5 py-4">
                            <?php if ($row['id'] == $_SESSION['user']['id']) : ?>
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">
                                    Aktif (Anda)
                                </span>
                            <?php else : ?>
                                <span class="inline-block bg-gray-100 text-gray-600 text-xs font-medium px-2.5 py-1 rounded-full">
                                    Admin
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-2">
                                <?php if ($row['id'] != $_SESSION['user']['id']) : ?>
                                    <a href="hapus_user.php?id=<?= $row['id'] ?>"
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')"
                                       class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                                        🗑️ Hapus
                                    </a>
                                <?php else : ?>
                                    <span class="text-gray-400 text-xs italic">Tidak dapat menghapus diri sendiri</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card View (mobile) -->
    <?php
    // Re-query untuk mobile view
    $queryMobile = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
    ?>
    <div class="md:hidden space-y-3">
        <?php while ($row = mysqli_fetch_assoc($queryMobile)) : ?>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-[#0f5c5c]/10 text-[#0f5c5c] rounded-full flex items-center justify-center font-bold text-sm">
                        <?= strtoupper(substr($row['username'], 0, 1)) ?>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800 text-sm"><?= htmlspecialchars($row['username']) ?></p>
                        <p class="text-gray-400 text-xs">
                            <?= $row['id'] == $_SESSION['user']['id'] ? 'Aktif (Anda)' : 'Admin' ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex justify-end border-t border-gray-50 pt-3">
                <?php if ($row['id'] != $_SESSION['user']['id']) : ?>
                    <a href="hapus_user.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')"
                       class="inline-flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white text-xs font-semibold px-3 py-1.5 rounded-lg transition">
                        🗑️ Hapus
                    </a>
                <?php else : ?>
                    <span class="text-gray-400 text-xs italic">Tidak dapat menghapus diri sendiri</span>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>

</main>

<?php include '../../layout/admin/footer.php'; ?>
