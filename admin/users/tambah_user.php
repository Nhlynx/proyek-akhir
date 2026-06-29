<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../../auth/login.php");
    exit;
}
include '../../koneksi.php';

$error = '';

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Validasi password cocok
    if ($password !== $konfirmasi_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        // Cek apakah username sudah terdaftar
        $cek_username = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($cek_username) > 0) {
            $error = "Username sudah digunakan oleh admin lain!";
        } else {
            // Hash password secara aman (bcrypt)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query = mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')");
            
            if ($query) {
                header("Location: users.php?notif=tambah");
                exit;
            } else {
                $error = "Gagal menambahkan admin baru!";
            }
        }
    }
}

$title = "Tambah Admin | Admin Panel";
include '../../layout/admin/header.php';
include '../../layout/admin/sidebar.php';
?>

<main class="flex-1 p-6 overflow-y-auto">

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
                <h2 class="font-bold text-gray-800 text-lg">Tambah Admin</h2>
                <p class="text-gray-400 text-xs mt-0.5">Daftarkan admin baru untuk mengelola sistem</p>
            </div>
        </div>
        <a href="users.php"
           class="inline-flex items-center gap-2 border border-gray-200 text-gray-600 px-4 py-2 rounded-xl text-sm font-semibold hover:border-[#0f5c5c] hover:text-[#0f5c5c] transition">
            ← Kembali
        </a>
    </div>

    <!-- Form Card -->
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-[#0f5c5c] px-6 py-4">
                <p class="text-white font-semibold text-sm">👥 Akun Admin Baru</p>
            </div>
            
            <form method="POST" class="p-6 space-y-5">
                <?php if (!empty($error)) : ?>
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                        <span>❌</span>
                        <span><?= $error ?></span>
                    </div>
                <?php endif; ?>

                <!-- Username -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Username <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="username" required placeholder="Masukkan username"
                           value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" required placeholder="Masukkan password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Konfirmasi Password <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="konfirmasi_password" required placeholder="Ulangi password"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                    <a href="users.php"
                       class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" name="submit"
                            class="px-5 py-2.5 bg-[#0f5c5c] hover:bg-[#0a4444] text-white rounded-xl text-sm font-semibold shadow-sm transition">
                        Simpan Admin
                    </button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php include '../../layout/admin/footer.php'; ?>
