<?php
include 'koneksi.php';

$error_msg = "Email atau Password salah!";
$success_msg = "Registrasi Berhasil!";

if (isset($_POST['register'])) {
    // Mengambil data dan mengamankannya
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Default role untuk pendaftar baru adalah 'user'
    $role     = 'user';

    // 1. Cek apakah email sudah digunakan
    $cek_email = mysqli_query($koneksi, "SELECT email FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($cek_email) > 0) {
        $error_msg = "Email sudah terdaftar! Gunakan email lain.";
    } else {
        // 2. Masukkan data ke database
        // Pastikan jumlah kolom di database sesuai (nama_lengkap, email, password, role)
        $query = "INSERT INTO users (nama_lengkap, email, password, role) 
                  VALUES ('$nama', '$email', '$password', '$role')";
        
        if (mysqli_query($koneksi, $query)) {
            // Jika berhasil, munculkan alert dan pindah ke login.php
            echo "<script>
                    alert('Registrasi Berhasil! Silakan Login.');
                    window.location='login.php';
                  </script>";
            exit;
        } else {
            $error_msg = "Terjadi kesalahan: " . mysqli_error($koneksi);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Petani GenZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center text-success fw-bold mb-4">Daftar Akun</h2>
            
            <?php if ($error_msg !== "") : ?>
                <div class="alert alert-danger shadow-sm small" role="alert">
                    <?= $error_msg; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="email@contoh.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" required>
                </div>
                
                <button type="submit" name="register" class="btn btn-success w-100 shadow-sm">Daftar Sekarang</button>
                
                <div class="mt-3 text-center">
                    <p class="mb-0">Sudah punya akun? <a href="login.php" class="text-decoration-none fw-bold text-success">Login di sini</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>