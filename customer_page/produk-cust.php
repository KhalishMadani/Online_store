<?php

require "../connection.php";
session_start();

$isLoggedIn = isset($_SESSION['username']);

if (isset($isLoggedIn) && $isLoggedIn) {
    include 'menu_authenticated.php';
} else {
    include 'menu_unauthenticated.php';
}

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

// get produk by keyword
if (isset($_GET['nama'])) {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama LIKE '%$_GET[nama]%'");
}

// get produk by kategori
else if (isset($_GET['kategori'])) {
    $kategori = $_GET['kategori'];
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kategori_id IN (SELECT id FROM kategori WHERE nama='$kategori')");
}

// get produk by default
else {
    $queryProduk = mysqli_query($conn, "SELECT * FROM produk");
}

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
    <link rel="stylesheet" href="../css/style.css">
    <title>Produk Customer</title>

    <style>
  .dark-bg {
    background-color: #333;
    color: #f7f8fa; 
  }
</style>

</head>

<body>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white ">
            <h1>Selamat Berbelanja</h1>
        </div>
    </div>

    <!-- body -->
    <div class="container py-5">
        <div class="row">

            <!-- kategori -->
            <div class="col-lg-3 mb-5">
                <h2 class="">Kategori</h2>
                <ul class="list-group">
                    <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                        <a href="produk-cust.php?kategori=<?php echo $kategori['nama']; ?>"
                            class="list-group-item list-group-item-action"><?php echo $kategori['nama']; ?>
                        </a>
                    <?php } ?>
                </ul>
            </div>

            <!-- produk -->
            <div class="col-lg-9">
                <div class="row">
                    <?php while ($produk = mysqli_fetch_array($queryProduk)) { ?>
                        <div class="col-sm-6 col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="image-box">
                                    <img src="../images/<?php echo $produk['foto']; ?>" alt="..." class="card-img-top">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <?php echo $produk['nama']; ?>
                                    </h5>
                                    <p class="card-text text-truncate">
                                        <?php echo $produk['detail']; ?>
                                    </p>
                                    <p>RP.
                                        <?php echo $produk['harga']; ?>
                                    </p>
                                    <a href="produk-detail.php?nama= <?php echo $produk['nama']; ?>"
                                        class="btn warna4">Lihat
                                        Detail</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer py-4 dark-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 text-lg-start">Copyright &copy; Your Website 2023</div>
                <div class="col-lg-4 my-3 my-lg-0">
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i
                            class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a style="color: #f7f8fa;" class=" text-decoration-none me-3" href="#!">Privacy Policy</a>
                    <a style="color: #f7f8fa;" class=" text-decoration-none" href="#!">Terms of Use</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer -->
    </div>
    <!-- End of .container -->
</body>

</html>