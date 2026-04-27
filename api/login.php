<?php
ini_set('session.save_path', '/tmp');
if (session_status() === PHP_SESSION_NONE) session_start();
 
require_once __DIR__ . '/koneksi.php';
 
// Sudah login → redirect langsung
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: " . ($_SESSION['role'] === 'admin' ? 'admin_dashboard.php' : 'dashboard.php'));
exit;
}
 
// Tampilkan pesan timeout jika ada
$timeout_msg = isset($_GET['timeout']) ? 'Sesi kamu telah berakhir. Silakan login kembali.' : '';
$error = '';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
 
    if (empty($email) || empty($password)) {
        $error = 'Email dan password tidak boleh kosong.';
    } else {
        $stmt = mysqli_prepare($koneksi,
            "SELECT id, nama_lengkap, password, role FROM users WHERE email = ? LIMIT 1"
        );
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
 
            if ($result && mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row['password'])) {
                    session_regenerate_id(true);
                    $_SESSION['login']         = true;
                    $_SESSION['id']            = $row['id'];
                    $_SESSION['nama']          = $row['nama_lengkap'];
                    $_SESSION['role']          = $row['role'];
                    $_SESSION['last_activity'] = time();

                    exit;
                }
            }
            mysqli_stmt_close($stmt);
        }
        $error = 'Email atau password salah.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Petani GenZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center text-success fw-bold mb-4">Login</h2>
            
            <?php if(isset($error)) : ?>
                <div class="alert alert-danger text-center">Email/Password Salah!</div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
            </div>
                <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>
                <button type="submit" name="login" class="btn btn-success w-100">Masuk</button>
                <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </form>
        </div>
    </div>
</body>
</html>