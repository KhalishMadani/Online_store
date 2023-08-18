<?php
require "../connection.php";

// Start the session
session_start();

$isLoggedIn = isset($_SESSION['username']);

if(isset($isLoggedIn) && $isLoggedIn){
    include 'menu_authenticated.php';
}
else{
    include 'menu_unauthenticated.php';
}

$nama = trim($_GET['nama']);

$queryProduk = mysqli_query($conn, "SELECT * FROM produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);

if (!$produk) {
    echo "produk not found";
} else {
    // Store the selected item details in the session
    $_SESSION['selectedItem'] = array(
        'nama_brg' => $produk['nama'],
        'harga' => $produk['harga']
    );
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Produk Detail</title>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-5">
            <img src="../images/<?php echo $produk['foto']; ?>" alt="..." class="card-img-top">
            </div>
            <div class="col">
                <h1><?php echo $produk['nama']; ?></h1>
                <p><?php echo $produk['detail']; ?></p>
                <p>RP <?php echo $produk['harga']; ?></p>
                <p>Stok: <?php echo $produk['ketersediaan_stok'] ." ". $produk['stock']; ?></p>
                <a href="produk-cust.php" class="btn warna4">Kembali</a>
                <a href="buy.php" class="btn warna2">Beli</a>
            </div>
        </div>
    </div>
</body>
</html>
