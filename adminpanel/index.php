<?php
require "../session/session.php";
require "navbar.php";
require "../connection.php";

$querykategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahkategori = mysqli_num_rows($querykategori);

$queryproduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahproduk = mysqli_num_rows($queryproduk);

$querypesanan = mysqli_query($conn, "SELECT * FROM orders");
$jumlahpesanan = mysqli_num_rows($querypesanan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
    <title>Document</title>
</head>
<style>
    .kotak {
        border: solid;
    }

    .summary-kategori {
        background-color: #0a6b4a;
        border-radius: 15px;
    }

    .summary-produk {
        background-color: #0ae;
        border-radius: 15px;
    }

    .summary-pesanan {
        background-color: #0a6b4a;
        border-radius: 15px;
    }

    .no-decoration {
        text-decoration: none;
    }
</style>

<body>

    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i class="fa-solid fa-house fa-bounce me-1"></i>Home</li></a>
            </ol>
        </nav>
        <h1>Halo Admin
        </h1>

        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-4 mb-3">
                    <div class="summary-kategori p-4">
                        <div class="row">
                            <div class="col-6">
                                <i class="fas fa-align-justify fa-5x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Kategori</h3>
                                <p class="fs-4">
                                    <?php echo $jumlahkategori; ?> Kategori</hp>
                                <p><a href="kategori.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 ">
                    <div class="summary-produk p-4 mb-3">
                        <div class="row">
                            <div class="col-6 ml">
                                <i class="fas fa-align-justify fa-5x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">Produk</h3>
                                <p class="fs-4">
                                    <?php echo $jumlahproduk; ?> Produk</hp>
                                <p><a href="produk.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 ">
                    <div class="summary-pesanan p-4 mb-3">
                        <div class="row">
                            <div class="col-6 ml">
                                <i class="fas fa-align-justify fa-5x text-black-50"></i>
                            </div>
                            <div class="col-6 text-white">
                                <h3 class="fs-2">pesanan</h3>
                                <p class="fs-4">
                                    <?php echo $jumlahpesanan; ?> pesanan</hp>
                                <p><a href="pesanan.php" class="text-white no-decoration">Lihat Detail</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</body>

</html>