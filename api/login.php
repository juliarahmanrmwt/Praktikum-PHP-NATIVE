<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
             $_SESSION['login'] = true;
             $_SESSION['id'] = $row['id'];
             $_SESSION['nama'] = $row['nama_lengkap'];
             $_SESSION['role'] = $row['role']; 

            if ($row['role'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        }
    }
    $error = true;
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