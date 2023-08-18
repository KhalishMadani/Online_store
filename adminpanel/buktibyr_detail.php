<?php
require "../connection.php";
require "../session/session.php";
require "navbar.php";

$id = $_GET['p'];
$query = mysqli_query($conn, "SELECT * FROM pembayaran where kode_pesanan = '$id' ");
$data = mysqli_fetch_array($query);

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
    <link rel="stylesheet" href="../css/style.css">
    <title>Detail Pembelian Barang Dari Suplier</title>
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
        height: 10vh;
        /* Adjust the height as needed */
    }
</style>

<script>
    function imprimir() {
        var divToPrint = document.getElementById("ConsutaBPM");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    $('button').on('click', function () {
        imprimir();
    })
</script>

<body>
    <!-- Div untuk detail Orders -->
    <div class="container mt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i
                            class="fa-solid fa-house fa-bounce me-1"></i>Home
                </li></a>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class=""></i>Orders Detail
                </li>
            </ol>
        </nav>

        <!-- Div untuk menampilkan Orders-->
        <div class="my-5 col-12 col-md-5" id="ConsutaBPM">
            <h3>Detail Orders</h3>

            <form action="" method="post" enctype="multipart/form-data" class="mt-5">
                <div>
                    <label for="">Kode Pesanan : </label>
                    <label for=""> <?php echo $data['kode_pesanan']; ?> </label>
                </div>

                <div>
                    <label for="">Customer : </label>
                    <label for=""> <?php echo $data['customer']; ?> </label>
                </div>

                <div>
                    <label for=""> Nama Barang : </label>
                    <label for=""> <?php echo $data['barang']; ?> </label>
                </div>
                
                <div>
                    <label for="">Harga : </label>
                    <label for=""> <?php echo $data['harga']; ?> </label>
                </div>

                <div>
                    <label for="">Jumlah Pembelian : </label>
                    <label for=""> <?php echo $data['qty']; ?> Pieces </label>
                </div>

                <div>
                    <label for="">Bayar : </label>
                    <label for=""> <?php echo $data['bayar']; ?> </label>
                </div>
               
                <div>
                    <label for="">Kembalian : </label>
                    <label for=""> <?php echo $data['kembalian']; ?> </label>
                </div>
               
                <div>
                    <label for="">Tipe Pesanan : </label>
                    <label for=""><strong> <?php echo $data['tipe']; ?> </strong></label>
                </div>

                <div>
                    <label for="">Tanggal Pesanan Dibuat : </label>
                    <label for=""> <?php echo $data['dibuat']; ?> </label>
                </div>
            </form>
        </div>
    </div>
    <div class="center">

        <button onclick="imprimir()" class="warna2" style="font-size: 20px; padding: 5px 20px;">Print</button>
    </div>
</body>

</html>