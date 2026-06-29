<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit;
}
include '../koneksi.php';

$error = '';
$sukses = '';

if (isset($_POST['submit'])) {
    $id_user = $_SESSION['user']['id'];
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];
    $konfirmasi_password = $_POST['konfirmasi_password'];

    // Ambil data user dari database untuk memverifikasi password lama
    $query_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id_user'");
    $user = mysqli_fetch_assoc($query_user);

    if ($user && password_verify($password_lama, $user['password'])) {
        if ($password_baru !== $konfirmasi_password) {
            $error = "Konfirmasi password baru tidak cocok!";
        } else {
            // Hash password baru (bcrypt)
            $hashed_password = password_hash($password_baru, PASSWORD_DEFAULT);
            $update = mysqli_query($conn, "UPDATE users SET password = '$hashed_password' WHERE id = '$id_user'");
            
            if ($update) {
                $sukses = "Password Anda berhasil diperbarui!";
            } else {
                $error = "Gagal memperbarui password!";
            }
        }
    } else {
        $error = "Password lama yang Anda masukkan salah!";
    }
}

$title = "Ubah Password | Admin Panel";
include '../layout/admin/header.php';
include '../layout/admin/sidebar.php';
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
                <h2 class="font-bold text-gray-800 text-lg">Ubah Password</h2>
                <p class="text-gray-400 text-xs mt-0.5">Amankan akun Anda dengan memperbarui password secara berkala</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-[#0f5c5c] px-6 py-4">
                <p class="text-white font-semibold text-sm">🔑 Formulir Ubah Password</p>
            </div>
            
            <form method="POST" class="p-6 space-y-5">
                <?php if (!empty($error)) : ?>
                    <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                        <span>❌</span>
                        <span><?= $error ?></span>
                    </div>
                <?php endif; ?>

                <?php if (!empty($sukses)) : ?>
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm font-semibold flex items-center gap-2">
                        <span>✅</span>
                        <span><?= $sukses ?></span>
                    </div>
                <?php endif; ?>

                <!-- Password Lama -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Password Lama <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_lama" required placeholder="Masukkan password saat ini"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Password Baru -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_baru" required placeholder="Masukkan password baru"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Konfirmasi Password Baru -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Konfirmasi Password Baru <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="konfirmasi_password" required placeholder="Ulangi password baru"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-[#0f5c5c]/30 focus:border-[#0f5c5c] transition">
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end gap-3 border-t border-gray-100 pt-5">
                    <a href="dashboard.php"
                       class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 text-sm font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" name="submit"
                            class="px-5 py-2.5 bg-[#0f5c5c] hover:bg-[#0a4444] text-white rounded-xl text-sm font-semibold shadow-sm transition">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </div>
    </div>

</main>

<?php include '../layout/admin/footer.php'; ?>
