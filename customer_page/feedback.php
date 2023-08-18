<?php
require "../connection.php";
session_start();

$code = $_GET['code'];
$customerName = $_SESSION['username'];

$orders = mysqli_query($conn, "SELECT * FROM orders WHERE code_byr ='$code'");
$fetchOrder = mysqli_fetch_array($orders);

if (isset($_POST['submit'])) {

    $customer = $customerName;
    $kode_beli = $_POST['code'];
    $nilaiKami = $_POST['gridRadios'];
    $komentar = $_POST['komentar'];

    $feedback = "INSERT INTO feedback (kode_beli, customer, kepuasan, komentar, tanggal) VALUES ('$kode_beli', '$customer', '$nilaiKami', '$komentar', CURRENT_TIMESTAMP)";
    $result = mysqli_query($conn, $feedback);

    $updateStatus = mysqli_query($conn, "UPDATE orders SET status_pesanan = 'complete' Where code_byr = '$kode_beli'");

    if ($result) {
        // Redirect back to the feedback form with a success message
        header('Location: riwayat_order.php');
        exit();
    } else {
        // Handle insertion error
        echo "Error inserting feedback: " . mysqli_error($conn);
    }
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
    <title>Feedback</title>
</head>

<body>
    <div class="container py-5">
        <form method="POST" action="feedback.php" >
            <div class="row mb-3">
                <label for="customer" class="col-sm-20 col-form-label"><h1>Feedback Order <?php echo $fetchOrder['code_byr']; ?></h1></label>
            </div>

            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Nilai Kami</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Sangat Baik"
                            checked>
                        <label class="form-check-label" for="gridRadios1">
                            Sangat Baik
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="Netral">
                        <label class="form-check-label" for="gridRadios2">
                            Netral
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="Kurang Baik">
                        <label class="form-check-label" for="gridRadios3">
                            Kurang Baik
                        </label>
                    </div>
                </div>
            </fieldset>

            <div class="row mb-3">
                <div class="col-10" >
                    Berikan Ulasan Anda Tentang Kami:
                </div>
                <div class="col-sm-10">
                    <textarea name="komentar" id="komentar" cols="70" rows="5"></textarea>
                </div>
            </div>
            <!-- input type hidden berfungsi agar data "code" bisa di retrieve dari form tanpa menampilkannya ke website -->
            <input type="hidden" name="code" value="<?php echo $fetchOrder['code_byr']; ?>">

            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>

</body>

</html>