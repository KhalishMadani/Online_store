<?php
require "../connection.php";
require "../session/session.php";
require "navbar.php";

if (isset($_GET['p'])) {
    $id = $_GET['p'];
    $query = mysqli_query($conn, "SELECT * FROM orders WHERE code_byr='$id'");
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
            $sql = "INSERT INTO s_diperjalanan (kode_pesanan, customer, diperjalanan, diperjalanan_timestamp) VALUES ('$kodePesanan','$customername', 'sedang di perjalanan', CURRENT_TIMESTAMP)";
            $orders = "UPDATE orders SET status_pesanan = 'diperjalanan' WHERE code_byr = '$kodePesanan'";
            break;
        case '2':
            $sql = "INSERT INTO s_delivered (kode_pesanan, customer, delivered, delivered_timestamp) VALUES ('$kodePesanan','$customername', 'sampai tujuan(delivered)', CURRENT_TIMESTAMP)";
            $orders = "UPDATE orders SET status_pesanan = 'delivered' WHERE code_byr = '$kodePesanan'";
            break;
        case '3':
            $sql = "INSERT INTO s_delivered (kode_pesanan, customer, delivered, delivered_timestamp) VALUES ('$kodePesanan','$customername', 'Pesanan Ditolak', CURRENT_TIMESTAMP)";
            $orders = "UPDATE orders SET status_pesanan = 'rejected' WHERE code_byr = '$kodePesanan'";
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
    .rejected-option {
        font-weight: bold;
        color: #cc0000;
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
                    <i class=""></i>Order Proggress(kurir)
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
                            <option value="1">sedang diperjalanan</option>
                            <option value="2">delivered</option>
                            <option class="rejected-option" value="3">Di Tolak Customer</option>
                        </select>
                        <button class="btn btn-outline-secondary" type="submit">Button</button>
                    </div>
                </form>
            </div>

            <div class="col">
                <h3>Proggress Pesanan</h3>
                <div class="table-responsive">
                    <table class="table">
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