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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer = $_POST['nama_customer'];
    $kode_pesanan = $_POST['kode_pesanan'];
    $barang = $_POST['nama_barang'];
    $harga = $_POST['harga'];
    $qty = $_POST['qty'];
    $tipe_bayar = $_POST['tipe_bayar'];
    $bayar = $_POST['bayar'];
    $kembalian = (int)$bayar - (int)$harga;

    $insert = '';
    switch ($tipe_bayar) {
        case 'transfer':
            $insert = "INSERT INTO pembayaran (kode_pesanan, customer, barang, harga, bayar, dibuat, qty, tipe, kembalian) VALUES ('$kode_pesanan','$customer','$barang','$harga','$harga', CURRENT_TIMESTAMP,'$qty','Transfer','0')";
            break;
        case 'cod':
            $insert = "INSERT INTO pembayaran (kode_pesanan, customer, barang, harga, bayar, dibuat, qty, tipe, kembalian) VALUES ('$kode_pesanan','$customer','$barang','$harga','$bayar', CURRENT_TIMESTAMP,'$qty','Cash On Delivery','$kembalian')";
            break;
        default:
            echo "invalid";
            break;
    }

    $existquery = mysqli_query($conn, "SELECT * FROM pembayaran WHERE kode_pesanan = '$kode_pesanan'");
    $fetch = mysqli_fetch_array($existquery);

    if ($fetch){
        echo "Data Telah Tersedia";
    } else {
        $result = mysqli_query($conn, $insert);
    }
}

$pembayaran = mysqli_query($conn, "SELECT * FROM pembayaran WHERE kode_pesanan = '$id'");
$bayar = mysqli_fetch_array($pembayaran);

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
    <title>Pembayaran</title>
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
                    <i class=""></i>Order Payment
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
                        <label for="kode_pesanan"><strong> Kode Pesanan </strong></label>
                        <input type="text" id="kode_pesanan" name="kode_pesanan"
                            value="<?php echo $data['code_byr']; ?>" class="form-control" style="font-weight: bold;"
                            readonly>
                    </div>

                    <div class="mt-3">
                        <label for="nama_barang"><strong> Nama Barang </strong></label>
                        <input type="text" id="nama_barang" name="nama_barang" value="<?php echo $data['nama_brg']; ?>"
                            class="form-control" style="font-weight: bold;" readonly>
                    </div>

                    <div class="mt-3">
                        <label for="harga">Harga Barang</label>
                        <input type="text" id="harga" name="harga" value="<?php echo $data['harga']; ?>"
                            class="form-control" style="font-weight: bold;" readonly>
                    </div>

                    <div class="mt-3">
                        <label for="qty">kuantitas</label>
                        <input type="text" id="qty" name="qty" value="<?php echo $data['qty']; ?>" class="form-control"
                            style="font-weight: bold;" readonly>
                    </div>

                    <div class="mt-3">
                        <label for="tipe">Tipe Pembayaran :</label>
                        <select name="tipe_bayar" id="tipe_bayar" required>
                            <option value="">pilih tipe pembayaran dibawah</option>
                            <option value="transfer">Transfer</option>
                            <option value="cod">Cash On Delivery</option>
                        </select>
                    </div>

                    <div class="mt-3" id="bayar" style="display: none;">
                        <label for="bayar">Bayar :</label>
                        <input type="number" name="bayar" id="bayar-input">
                    </div>

                    <button class="btn btn-outline-secondary" type="submit">Submit</button>
                </form>
            </div>

            <script>
                var tipeBayar = document.getElementById('tipe_bayar');
                var bayarDiv = document.getElementById('bayar');
                var bayarInput = document.getElementById('bayar-input');

                tipeBayar.addEventListener('change', function () {
                    if (tipeBayar.value === 'cod') {
                        bayarDiv.style.display = 'block';
                        bayarInput.readOnly = false;
                    } else {
                        bayarDiv.style.display = 'none';
                        bayarInput.readOnly = true;
                    }
                });
            </script>


            <!-- hasil pembayaran div -->
            <div class="col">
                <h3>Pembayaran</h3>
                <div class="container py-5">
                    <h1>Order Payment</h1>
                    <?php
                    if ($bayar == 0){
                        echo "-----isi data diatas-----";
                    } else {

                     ?>
                    <p>Kode Pesanan:
                        <?php echo $bayar['kode_pesanan']; ?>
                    </p>
                    <p>Customer:
                        <?php echo $bayar['customer']; ?>
                    </p>
                    <p>Nama Barang:
                        <?php echo $bayar['barang']; ?>
                    </p>
                    <p>Harga:
                        <?php echo $bayar['harga']; ?>
                    </p>
                    <p>Kuantitas:
                        <?php echo $bayar['qty']; ?>
                    </p>
                    <p>Uang Bayar:
                        <?php echo $bayar['bayar']; ?>
                    </p>
                    <p>Kembalian:
                        <?php echo $bayar['kembalian']; ?>
                    </p>
                    <p>Tipe Pembayaran:
                        <?php echo $bayar['tipe']; ?>
                    </p>
                    <p>Dibikin Pada:
                        <?php echo $bayar['dibuat']; ?>
                    </p>
                <?php }
                ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>