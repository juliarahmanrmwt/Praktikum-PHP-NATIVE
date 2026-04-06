<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$namaUser = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Petani GenZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card:hover {
            transform: translateY(-5px);
            transition: 0.3s;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Petani GenZ</a>
            <div class="ms-auto d-flex align-items-center">
                <span class="text-white me-3">Halo, <strong><?php echo $namaUser; ?></strong>!</span>
                <a href="../Proses/logout.php" class="btn btn-outline-light btn-sm">Keluar</a>
            </div>
        </div>
    </nav>

    <header class="bg-success-subtle py-5 text-center">
        <div class="container">
            <h1 class="display-5 fw-bold text-success">Pasar Tani Digital</h1>
            <p class="lead">Produk segar langsung dari tangan petani lokal untuk <strong><?php echo $namaUser; ?></strong>.</p>
        </div>
    </header>

    <main class="container my-5">
        <div class="row g-4">
            
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <img src="https://images.unsplash.com/photo-1588252303782-cb80119f702e?q=80&w=500&auto=format&fit=crop" 
                    class="card-img-top" alt="Cabai Merah Segar" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <small class="text-success fw-bold text-uppercase">Bumbu</small>
                        <h5 class="card-title">Cabai Merah Segar</h5>
                        <p class="card-text text-danger fw-bold">Rp 18.000</p>
                        <a href="#" class="btn btn-success w-100">Beli Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <img src="https://images.unsplash.com/photo-1592924357228-91a4daadcfea?auto=format&fit=crop&w=500&q=80" 
                         class="card-img-top" alt="Tomat" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <small class="text-success fw-bold text-uppercase">Sayuran</small>
                        <h5 class="card-title">Tomat Merah</h5>
                        <p class="card-text text-danger fw-bold">Rp 18.000</p>
                        <a href="#" class="btn btn-success w-100">Beli Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <img src="https://images.pexels.com/photos/2329440/pexels-photo-2329440.jpeg?auto=compress&cs=tinysrgb&w=400" 
                         class="card-img-top" alt="Timun Segar" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <small class="text-success fw-bold text-uppercase">Sayuran</small>
                        <h5 class="card-title">Timun Segar</h5>
                        <p class="card-text text-danger fw-bold">Rp 15.000</p>
                        <a href="#" class="btn btn-success w-100">Beli Sekarang</a>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm product-card">
                    <img src="https://images.pexels.com/photos/144248/potatoes-vegetables-market-fresh-144248.jpeg?auto=compress&cs=tinysrgb&w=400" 
                         class="card-img-top" alt="Kentang" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <small class="text-success fw-bold text-uppercase">Sayuran</small>
                        <h5 class="card-title">Kentang Dieng</h5>
                        <p class="card-text text-danger fw-bold">Rp 20.000</p>
                        <a href="#" class="btn btn-success w-100">Beli Sekarang</a>
                    </div>
                </div>
            </div>

        </div> 
    </main>

    <footer class="text-center py-4 text-muted">
        <small>&copy; 2026 Petani GenZ - Dashboard Pengguna</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>