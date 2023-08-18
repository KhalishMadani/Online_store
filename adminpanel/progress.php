<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";

$queryOrders = mysqli_query($conn, "SELECT * FROM orders");

$kode = mysqli_query($conn, "SELECT code_byr FROM orders ");
$conversionkode = mysqli_fetch_assoc($kode);
$kode_pesanan = $conversionkode['code_byr'];

$querys_proses = mysqli_query($conn, "SELECT * FROM s_proses WHERE kode_pesanan = '$kode_pesanan' ");

$querys_kemas = mysqli_query($conn, "SELECT * FROM s_kemas WHERE kode_pesanan = '$kode_pesanan'");
$querys_kurir = mysqli_query($conn, "SELECT * FROM s_kurir WHERE kode_pesanan = '$kode_pesanan'");
$querys_diperjalanan = mysqli_query($conn, "SELECT * FROM s_diperjalanan WHERE kode_pesanan = '$kode_pesanan'");
$querys_delivered = mysqli_query($conn, "SELECT * FROM s_delivered WHERE kode_pesanan = '$kode_pesanan'");
$querys_selesai = mysqli_query($conn, "SELECT * FROM s_selesai WHERE kode_pesanan = '$kode_pesanan'");

$jumlahOrders = mysqli_num_rows($queryOrders);
$jumlahs_proses = mysqli_num_rows($querys_proses);
$jumlahs_kemas = mysqli_num_rows($querys_kemas);
$jumlahs_kurir = mysqli_num_rows($querys_kurir);
$jumlahs_diperjalanan = mysqli_num_rows($queryOrders);
$jumlahs_delivered = mysqli_num_rows($querys_delivered);
$jumlahs_selesai = mysqli_num_rows($querys_selesai);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proggress Report</title>
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

<body>
    <div class="container mt-5">

        <!-- tabel -->
        <div class="mt-3">
            <h2>Proggress Table</h2>
            <div class="table-responsive">
                <table class="table">

                    <!-- head tabel-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Nama Customer</th>
                            <th>Nama Barang</th>
                            <th>Dibuat Pada</th>
                            <th>Status Pesanan</th>
                            <th>Detail</th>
                        </tr>
                    </thead>

                    <!-- body tabel-->
                    <tbody>
                        <?php
                        $counter = 1;
                        while ($data1 = mysqli_fetch_array($queryOrders)) {
                            echo "<tr>";
                            echo "<td>" . $counter . "</td>";
                            echo "<td>" . $data1['code_byr'] . "</td>";
                            echo "<td>" . $data1['nama_customer'] . "</td>";
                            echo "<td>" . $data1['nama_brg'] . "</td>";
                            echo "<td>" . $data1['dibikin_pada'] . "</td>";
                            echo "<td><strong>" . $data1['status_pesanan'] . "</strong></td>";
                            echo '<td><a href="report_pesanan_detail.php?p=' . $data1['code_byr'] . '" class="btn btn-warning">'."Detail".'</a></td>';

                            // if ($data2 = mysqli_fetch_array($querys_proses)) {
                            //     echo "<tr>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";

                            //     echo "<td>" . $data2['process'] . "</td>";
                            // } else {
                            //     echo "data kosong";
                            // }

                            
                            // if ($data3 = mysqli_fetch_array($querys_kemas)) {
                            //     echo "<tr>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";

                            //     echo "<td>" . $data3['kemas'] . "</td>";
                            // } else {
                            //     echo "data kosong";
                            // }

                            // if ($data4 = mysqli_fetch_array($querys_kurir)) {
                            //     echo "<tr>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";

                            //     echo "<td>" . $data4['kurir'] . "</td>";
                            // } else {
                            //     echo "data kosong";
                            // }

                            // if ($data5 = mysqli_fetch_array($querys_diperjalanan)) {
                            //     echo "<tr>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" . $data5['diperjalanan'] . "</td>";
                            // } else {
                            //     echo "data kosong";
                            // }

                            // if ($data6 = mysqli_fetch_array($querys_delivered)) {
                            //     echo "<tr>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
  
                            //     echo "<td>" . $data6['delivered'] . "</td>";
                            // } else {
                            //     echo "data kosong";
                            // }

                            // if ($data7 = mysqli_fetch_array($querys_selesai)) {
                            //     echo "<tr>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";
                            //     echo "<td>" ."</td>";

                            //     echo "<td>" . $data7['selesai'] . "</td>";
                            // } else {
                            //     echo "data kosong";
                            // }
                            $counter++;
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>