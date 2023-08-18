<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";

$id = $_GET['p'];

$querybayar = mysqli_query($conn, "SELECT * FROM pembayaran where customer='$id'");
$fetchBayar = mysqli_fetch_array($querybayar);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Customer</title>
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
    <style>
        .icon {
            font-size: 24px;
        }

        .no-decoration {
            text-decoration: none;
        }

        a {
            text-decoration: none;
            padding-right: 10px;
        }
    </style>
</head>

<script>

    function imprimir() {
        var divToPrint = document.getElementById("ConsutaBPM");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    function goBack() {
    window.history.back();
  }

    $('button').on('click', function () {
        imprimir();
    })

</script>

<body>
    <div class="container mt-5">

        <!-- breadcrumb header Produk-->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i
                            class="fa-solid fa-house fa-bounce me-1"></i>Home
                </li></a>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class=""></i>Riwayat
                </li>
            </ol>
        </nav>

        <!-- tabel -->
        <div id="ConsutaBPM" class="mt-3">
            <h2>Riwayat Pesanan:
                <?php echo $fetchBayar['customer']; ?>
            </h2>
            <div class="table-responsive">
                <table border="1" cellpadding="4" id="printTable" class="table">

                    <!-- head tabel-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pesanan</th>
                            <th>Nama Barang</th>
                            <th>Tipe Pembayaran</th>
                            <th>Dibuat Pada</th>
                        </tr>
                    </thead>

                    <!-- body tabel-->
                    <tbody>
                        <?php
                        if (!$fetchBayar) {
                            echo "<tr><td colspan='6'>Data kosong</td></tr>";
                        } else {
                            $jumlah = 1;
                            do {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $jumlah; ?>
                                    </td>
                                    <td>
                                        <?php echo $fetchBayar['kode_pesanan']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fetchBayar['barang']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fetchBayar['tipe']; ?>
                                    </td>
                                    <td>
                                        <?php echo $fetchBayar['dibuat']; ?>
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                            } while ($fetchBayar = mysqli_fetch_array($querybayar));
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="center">
        <a href="index.php" class="btn"> Back </a> 
        <button onclick="imprimir()" class="warna2" style="font-size: 20px; padding: 5px 20px;" >Print Table</button>
    </div>
    </div>

</body>

</html>