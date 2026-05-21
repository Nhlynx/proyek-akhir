<?php
// session_start();
include __DIR__ . '/../koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($query);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header("Location: /proyek-akhir/admin/dashboard.php");
        exit;
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<div class="bg-white p-6 rounded shadow w-80">
    <h2 class="text-xl font-bold mb-4 text-center">Login Admin</h2>

    <?php if (isset($error)): ?>
        <p class="text-red-500 text-sm mb-2"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" class="w-full border p-2 mb-3 rounded" required>
        <input type="password" name="password" placeholder="Password" class="w-full border p-2 mb-3 rounded" required>
        <button type="submit" name="login" class="w-full bg-[#0f5c5c] text-white py-2 rounded">Login</button>
    </form>
</div>

</body>
</html>