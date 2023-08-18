<?php
session_start();
require "../connection.php";

if (!isset($_SESSION['username'])) {
    // User is not logged in, redirect to user creation page
    header('Location: ../session/login.php');
    exit();
} else {
    // User is logged in, retrieve the selected product name from the query parameter
    $namabrg = trim($_GET['nama']); 

    // Retrieve the product details from the database based on the selected product name
    $query = "SELECT * FROM produk WHERE nama = '$namabrg'";
    $result = mysqli_query($conn, $query);
    $produk = mysqli_fetch_assoc($result);

    // Add the selected product to the chosen items array or shopping cart in the session
    $_SESSION['chosenItems'][] = $produk;

    // Redirect the customer to the checkout page or any other desired page
    header('Location: checkout.php');
    exit();
}
?>
