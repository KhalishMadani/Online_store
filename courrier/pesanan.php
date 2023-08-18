<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";

$querypesanan = mysqli_query($conn, "SELECT * FROM orders");
$jumlahpesanan = mysqli_num_rows($querypesanan);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Pesanan</title>
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
</head>

<script>
    function deleteItem(itemId) {
        if (confirm("Are you sure you want to delete this item?")) {
            // Send an AJAX request to delete.php
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "delete-produk.php?p=" + itemId, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display the result on the page
                    alert(xhr.responseText);
                    // Refresh the current page
                    location.reload();
                }
            };
            xhr.send();
        }
    }
</script>

<style>
    .no-decoration {
        text-decoration: none;
    }
</style>

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
                    <i class=""></i>Ongoing Order(kurir)
                </li>
            </ol>
        </nav>

        <!-- tabel -->
        <div class="mt-3">
            <h2>List Produk</h2>
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
                        </tr>
                    </thead>

                    <!-- body tabel-->
                    <tbody>
                        <?php
                        if ($jumlahpesanan == 0) {
                            echo "data kosong";
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($querypesanan)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $jumlah; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['code_byr']; ?>
                                    </td>

                                    <td>
                                        <?php echo $data['nama_customer']; ?>
                                    </td>

                                    <td>
                                        <?php echo $data['nama_brg']; ?>
                                    </td>

                                    <td>
                                        <?php echo $data['dibikin_pada']; ?>
                                    </td>
                                    <td>
                                    <?php
                                        if (empty($data['status_pesanan'])) { ?>
                                            <a href="pesanan_detail.php?p=<?php echo $data['code_byr']; ?> " class="btn btn-warning">Pending</a> 
                                            <?php
                                        } else { ?>
                                        <a href="pesanan_detail.php?p=<?php echo $data['code_byr']; ?>" class="btn btn-warning" ><?php echo $data['status_pesanan']; ?> </a><?php
                                            
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                            }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>