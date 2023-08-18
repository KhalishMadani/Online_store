<?php
// Retrieve the values from URL parameters
$price = $_GET['price'];
$quantity = $_GET['quantity'];
$code_byr = $_GET['code_byr'];

require "../connection.php";

// Start the session
session_start();

// Retrieve customer name, alamat, kota, and kode_pos from the customer table (assuming customer is logged in)
$customerName = $_SESSION['username'];

$query = "SELECT nama, alamat, kota, kode_pos FROM customer WHERE username = '$customerName'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
$alamat = $row['alamat'];
$kota = $row['kota'];
$kode_pos = $row['kode_pos'];

// Retrieve selected item details from the session
$selectedItem = $_SESSION['selectedItem'];
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
    <title>Order Success</title>
</head>

<body>
        <div class="container py-5">
            <h1>Order Success</h1>
            <p>Customer: <?php echo $nama; ?></p>
            <p>Nama Barang: <?php echo $selectedItem['nama_brg']; ?></p>
            <p>Alamat: <?php echo $alamat; ?></p>
            <p>Kota: <?php echo $kota; ?></p>
            <p>Kode Pos: <?php echo $kode_pos; ?></p>
            <p>Harga: <?php echo $price; ?></p>
            <p>Quantity: <?php echo $quantity; ?></p>
            <p>Kode Pesanan: <?php echo $code_byr; ?></p>
            <a href="produk-cust.php" class="btn btn-info" >Kembali</a>
        </div>
</body>
</html>
