<?php
session_start();
include '../api/koneksi.php';

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    
    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['nama'] = $row['nama_lengkap'];
            $_SESSION['role'] = $row['role']; // Simpan role di session

            // Arahkan berdasarkan role
            if ($row['role'] == 'admin') {
                header("Location: ../api/admin_dashboard.php");
            } else {
                header("Location: ../api/dashboard.php");
            }
            exit;
        }
    }
    header("Location: ../api/login.php?error=1");
    exit;
}
?>