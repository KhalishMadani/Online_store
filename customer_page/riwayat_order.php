<?php
require "../connection.php";
require "menu_authenticated.php";
session_start();

$customerName = $_SESSION['username'];

$riwayatquery = mysqli_query($conn, "SELECT * FROM orders WHERE nama_customer = '$customerName'");
$history = mysqli_num_rows($riwayatquery);


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
    <title>Order History</title>
</head>

<body>

    <div class="mt-3">
        <h2>List Produk</h2>
        <div class="table-responsive">
            <table class="table">

                <!-- head tabel-->
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                        <th>Kode Pos</th>
                        <th>Kode Pesanan</th>
                        <th>Tanggal Pesanan</th>
                        <th>Status Pesanan</th>
                        <th>Konfirmasi</th>
                    </tr>
                </thead>

                <!-- body tabel-->
                <tbody>
                    <?php
                    if ($history == 0) {
                        echo "data kosong";
                    } else {
                        $jumlah = 1;
                        while ($data = mysqli_fetch_array($riwayatquery)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $jumlah; ?>
                                </td>
                                <td>
                                    <?php echo $data['nama_customer']; ?>
                                </td>
                                <td>
                                    <?php echo $data['nama_brg']; ?>
                                </td>
                                <td>
                                    <?php echo $data['harga']; ?>
                                </td>
                                <td>
                                    <?php echo $data['alamat']; ?>
                                </td>
                                <td>
                                    <?php echo $data['kota']; ?>
                                </td>
                                <td>
                                    <?php echo $data['kode_pos']; ?>
                                </td>
                                <td>
                                    <?php echo $data['code_byr']; ?>
                                </td>
                                <td>
                                    <?php echo $data['created_at']; ?>
                                </td>
                                <td>
                                    <?php if ($data['status_pesanan'] === 'complete'): ?>
                                    <strong style="color: #009933;"><?php echo $data['status_pesanan']; ?></strong>

                                    <?php elseif($data['status_pesanan'] === 'Rejected'): ?>
                                        <strong style="color: #cc0000;"><?php echo $data['status_pesanan']; ?></strong>
                                        
                                        <?php else : echo $data['status_pesanan']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($data['status_pesanan'] === 'delivered'): ?>
                                        <form method="POST" action="">

                                            <!-- <button type="submit" name="feedback" class="btn btn-success">feedback</button> -->
                                            <a href="feedback.php?code= <?php echo $data['code_byr']; ?>" class="btn btn-primary">Feedback</a>
                                        </form>

                                        <?php elseif ($data['status_pesanan'] === 'complete'): ?>
                                            <p><strong>Dinilai</strong></p>
                                    <?php endif; ?>
                                </td>

                                <?php
                                $jumlah++;
                        }
                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="">
        <a href="profile.php" class="btn btn-warning"> back </a>
    </div>

</body>

</html>