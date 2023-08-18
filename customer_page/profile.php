<?php 
require "../connection.php";
require "menu_authenticated.php";

session_start();

$customerName = $_SESSION['username'];
$queryUser = "SELECT nama, alamat, kota, kode_pos FROM customer WHERE username = '$customerName'";
$result = mysqli_query($conn, $queryUser);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
$alamat = $row['alamat'];
$kota = $row['kota'];
$kode_pos = $row['kode_pos'];


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
    <title>Profile</title>
</head>
<body>
<div class="container py-5">
        <div class="row">

            <!-- kategori -->
            <div class="col-lg-3 mb-5">
                <h2 class="">Profile</h2>
                <ul class="list-group">
                        <a href="profile_edit.php" class="list-group-item list-group-item-action">Edit Profile</a>
                        <a href="riwayat_order.php" class="list-group-item list-group-item-action">Riwayat Order</a>
                </ul>
              
            </div>

            <!-- produk -->
            <div class="col-lg-9">
                <div class="row">
                    <h2>User</h2>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <h5><?php echo $nama; ?></h5>
                        <p><?php echo $alamat; ?></p>
                        <p><?php echo $kota; ?></p>
                        <p><?php echo $kode_pos; ?></p>
                        </div>
                  
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>