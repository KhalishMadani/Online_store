<?php

require "connection.php";
session_start();

$isLoggedIn = isset($_SESSION['username']);

if(isset($isLoggedIn) && $isLoggedIn){
    include 'include/menu_authenticated.php';
}
else{
    include 'include/menu_unauthenticated.php';
}



$queryProduk = mysqli_query($conn, "SELECT id, nama, foto, harga, detail FROM produk LIMIT 6");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap-5/css/bootstrap.min.css">
    <script src="bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="fontawesome-6/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Online Shop</title>
</head>

<body>

    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white ">
            <h1>Halo</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form action="customer_page/produk-cust.php" method="get">
                    <div class="input-group my-4">
                        <input type="text" class="form-control" name="nama" placeholder="Tuliskan Nama Barang Disini"
                            aria-label="Nama Produk" aria-describedby="basic-addon2">
                        <button class="btn warna2" type="submit">Search</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!--highlighted Kategori  -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori</h3>

            <div class="row mt-3">
                <div class="col-4">
                    <div class="highlighted-kategori man text-kategori"
                        style="display: flex; justify-content: center; align-items: center;">
                        <h5><a href="customer_page/produk-cust.php?kategori=Pria" class="no-decoration">Pakaian Pria</a></h5>
                    </div>

                </div>
                <div class="col-4">
                    <div
                        class="highlighted-kategori woman text-kategori d-flex justify-content-center align-items-center">
                        <h5><a href="customer_page/produk-cust.php?kategori=Wanita" class="no-decoration">Pakaian Wanita</a>
                        </h5>
                    </div>

                </div>
                <div class="col-4">
                    <div
                        class="highlighted-kategori shoes text-kategori d-flex justify-content-center align-items-center">
                        <h5><a href="customer_page/produk-cust.php?kategori=Aksesories" class="no-decoration">Aksesories</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5">
                <!-- Perulangan While -->
                <?php while ($data = mysqli_fetch_array($queryProduk)) { ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="image-box">
                                <img src="images/<?php echo $data['foto']; ?>" alt="..." class="card-img-top">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?php echo $data['nama']; ?>
                                </h5>
                                <p class="card-text text-truncate">
                                    <?php echo $data['detail']; ?>
                                </p>
                                <p>RP.
                                    <?php echo $data['harga']; ?>
                                </p>
                                <a href="customer_page/produk-detail.php?nama= <?php echo $data['nama']; ?>" class="btn warna4">Lihat
                                    Detail</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a href="customer_page/produk-cust.php" class="btn btn-outline-warning mt-3">See More</a>
        </div>
    </div>

</body>

</html>