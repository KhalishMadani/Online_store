<?php
require "../connection.php";
require "../session/session.php";
require "navbar.php";

if (isset($_GET['p'])) {
    $id = $_GET['p'];
    $query = mysqli_query($conn, "SELECT * FROM orders WHERE code_byr = '$id'");
    if ($query) {
        $data = mysqli_fetch_array($query);
    } else {
        echo 'Error fetching data: ' . mysqli_error($conn);
        exit;
    }
} else {
    echo 'Invalid request';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectValue = $_POST['proggress'];
    $kodePesanan = $_POST['nama'];
    $customername = $_POST['nama_customer'];

    $sql = '';
    $orders = '';
    switch ($selectValue) {
        case '1':
            $sql = "INSERT INTO s_proses (kode_pesanan, customer, process, process_timestamp) VALUES ('$kodePesanan','$customername', 'sedang di proses', CURRENT_TIMESTAMP)";
            $orders = "UPDATE orders SET status_pesanan = 'sedang di proses' WHERE code_byr = '$kodePesanan'";
            break;
        case '2':
            $sql = "INSERT INTO s_kemas (kode_pesanan, customer, kemas, kemas_timestamp) VALUES ('$kodePesanan','$customername', 'telah dikemas', CURRENT_TIMESTAMP)";
            $orders = "UPDATE orders SET status_pesanan = 'telah dikemas' WHERE code_byr = '$kodePesanan'";
            break;
        case '3':
            $sql = "INSERT INTO s_kurir (kode_pesanan, customer, kurir, kurir_timestamp) VALUES ('$kodePesanan','$customername', 'diserahkan kepada kurir', CURRENT_TIMESTAMP)";
            $orders = "UPDATE orders SET status_pesanan = 'diserahkan kepada kurir' WHERE code_byr = '$kodePesanan'";
            break;
        default:
            echo "Invalid selection";
            break;
    }

    $resultSql = mysqli_query($conn, $sql);
    if (!$resultSql) {
        echo "Error executing SQL query: " . mysqli_error($conn);
    }

    // Execute $orders query
    $resultOrders = mysqli_query($conn, $orders);
    if (!$resultOrders) {
        echo "Error executing orders query: " . mysqli_error($conn);
    }
    else { ?>
        <div class="alert alert-primary" role="alert"> Berhasil di Proses </div> <?php

    }

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
    <title>Proggress Pesanan</title>
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }

    form div {
        margin-bottom: 10px;
    }

    .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh; /* Adjust the height as needed */
        }
</style>

<body>
    <div class="container mt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i
                            class="fa-solid fa-house fa-bounce me-1"></i>Home
                </li></a>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class=""></i>Order Proggress
                </li>
            </ol>
        </nav>

        <!-- Div untuk edit produk-->
        <div class="container py-5">
            <div class="row my-5 col-12 col-md-5">

                <h3>Customer</h3>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="mt-3">
                        <label for="nama_customer"><strong> Nama Customer </strong></label>
                        <input type="text" id="nama_customer" name="nama_customer"
                            value="<?php echo $data['nama_customer']; ?>" class="form-control"
                            style="font-weight: bold;" readonly>
                    </div>
                    <div class="mt-3">
                        <label for="nama"><strong> Kode Pesanan </strong></label>
                        <input type="text" id="nama" name="nama" value="<?php echo $data['code_byr']; ?>"
                            class="form-control" style="font-weight: bold;" readonly>
                    </div>

                    <label for="proggress">Tentukan Proggress Pesanan</label>
                    <div class="input-group mt-2">
                        <select class="form-select" id="inputGroupSelect04"
                            aria-label="Example select with button addon" name="proggress">
                            <option selected>Choose...</option>
                            <option value="1">sedang di proses</option>
                            <option value="2">telah dikemas</option>
                            <option value="3">diserahkan kepada kurir</option>
                        </select>
                        <button class="btn btn-outline-secondary" type="submit">Update</button>
                    </div>
                </form>
            </div>

            <div class="col">
                <h3>Proggress Pesanan</h3>
                <div class="table-responsive">
                    <table border="1" cellpadding="4" class="table">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $s_proses = mysqli_query($conn, "SELECT * FROM s_proses where kode_pesanan = '$id'");
                            $proccess = mysqli_fetch_array($s_proses);

                            $s_kemas = mysqli_query($conn, "SELECT * FROM s_kemas where kode_pesanan = '$id'");
                            $kemas = mysqli_fetch_array($s_kemas);

                            $s_kurir = mysqli_query($conn, "SELECT * FROM s_kurir where kode_pesanan = '$id'");
                            $kurir = mysqli_fetch_array($s_kurir);

                            $s_diperjalanan = mysqli_query($conn, "SELECT * FROM s_diperjalanan where kode_pesanan = '$id'");
                            $diperjalanan = mysqli_fetch_array($s_diperjalanan);

                            $s_delivered = mysqli_query($conn, "SELECT * FROM s_delivered where kode_pesanan = '$id'");
                            $delivered = mysqli_fetch_array($s_delivered);

                            $s_selesai = mysqli_query($conn, "SELECT * FROM s_selesai where kode_pesanan = '$id'");
                            $selesai = mysqli_fetch_array($s_selesai);
                            ?>
                            <?php if (!empty($proccess['process'])): ?>
                                <tr>
                                    <td>
                                        <?php echo $proccess['process']; ?>
                                    </td>
                                    <td>
                                        <?php echo $proccess['process_timestamp']; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if (!empty($kemas['kemas'])): ?>
                                <tr>
                                    <td>
                                        <?php echo $kemas['kemas']; ?>
                                    </td>
                                    <td>
                                        <?php echo $kemas['kemas_timestamp']; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if (!empty($kurir['kurir'])): ?>
                                <tr>
                                    <td>
                                        <?php echo $kurir['kurir']; ?>
                                    </td>
                                    <td>
                                        <?php echo $kurir['kurir_timestamp']; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if (!empty($diperjalanan['diperjalanan'])): ?>
                                <tr>
                                    <td>
                                        <?php echo $diperjalanan['diperjalanan']; ?>
                                    </td>
                                    <td>
                                        <?php echo $diperjalanan['diperjalanan_timestamp']; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if (!empty($delivered['delivered'])): ?>
                                <tr>
                                    <td>
                                        <?php echo $delivered['delivered']; ?>
                                    </td>
                                    <td>
                                        <?php echo $delivered['delivered_timestamp']; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>

                            <?php if (!empty($selesai['selesai'])): ?>
                                <tr>
                                    <td>
                                        <?php echo $selesai['selesai']; ?>
                                    </td>
                                    <td>
                                        <?php echo $selesai['selesai_timestamp']; ?>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>