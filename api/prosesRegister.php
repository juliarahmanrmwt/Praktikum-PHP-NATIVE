<?php
include 'koneksi.php'; 

if (isset($_POST['register'])) {
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $cek_email = mysqli_query($conn, "SELECT email FROM users WHERE email='$email'");
    
    if (mysqli_num_rows($cek_email) > 0) {
        echo "<script>alert('Email sudah terdaftar!'); window.location='api/register.php';</script>";
    } else {
        $query = "INSERT INTO users (nama_lengkap, email, password) VALUES ('$nama', '$email', '$password')";
        
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Berhasil daftar! Silakan login.'); window.location='login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>