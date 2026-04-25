<?php
$conn = mysqli_connect("localhost", "root", "", "db_petani");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>