<?php
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

// Function to calculate the total price based on quantity and original price
function calculateTotalPrice($quantity, $price)
{
    return $quantity * $price;
}

// Function to decrease the quantity of a product
function decreaseQuantity($productName, $quantity)
{
    global $conn;

    $query = "UPDATE produk SET stock = stock - $quantity WHERE nama = '$productName'";
    mysqli_query($conn, $query);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $productName = $selectedItem['nama_brg'];
    $quantity = $_POST['qty'];

    // Retrieve the harga from the produk table
    $query = "SELECT harga FROM produk WHERE nama = '$productName'";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    $price = $product['harga'];

    // Calculate the total price
    $totalPrice = calculateTotalPrice($quantity, $price);

    // Generate a random resi number
    $code_byr = mt_rand(100000, 999999);

    // Insert the order into the orders table
    $query = "INSERT INTO orders (nama_brg, qty, harga, nama_customer, alamat, kota, kode_pos, code_byr, status_pesanan)
          VALUES ('$productName', $quantity, $totalPrice, '$customerName', '$alamat', '$kota', '$kode_pos', $code_byr, 'pending')";
    mysqli_query($conn, $query); // Execute the query and handle any errors

    // Decrease the quantity of the purchased product
    decreaseQuantity($productName, $quantity);

    // Redirect to the order success page or perform any other actions
    header('Location: order-success.php?price=' . $totalPrice . '&quantity=' . $quantity . '&code_byr=' . $code_byr);
    exit();
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
    <title>Checkout</title>
</head>

<body>
    <div class="container py-5">
        <h1>Checkout</h1>
        <p>Customer:
            <?php echo $nama; ?>
        </p>
        <p>Alamat:
            <?php echo $alamat; ?>
        </p>
        <p>Kota:
            <?php echo $kota; ?>
        </p>
        <p>Kode Pos:
            <?php echo $kode_pos; ?>
        </p>

        <form method="POST" action="checkout.php">
            <div class="form-group">
                <label for="nama">Nama Barang</label>
                <input type="text" value="<?php echo $selectedItem['nama_brg']; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="text" value="<?php echo $selectedItem['harga']; ?>" class="form-control" readonly>
            </div>
            <div class="form-group">
                <label for="qty">Quantity</label>
                <input type="number" name="qty" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 mt-4">
                    <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                </div>
                <div class="col-md-6 mb-3 mt-4">
                    <a href="produk-detail.php?nama=<?php echo $selectedItem['nama_brg']; ?>"
                        class="btn btn-danger btn-block">Batal</a>
                </div>
            </div>
        </form>

    </div>

</html>