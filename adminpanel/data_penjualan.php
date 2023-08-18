<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";

$queryOrders = mysqli_query($conn, "SELECT * FROM orders WHERE status_pesanan = 'complete' ");
$jumlahOrders = mysqli_num_rows($queryOrders);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table Penjualan</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
    <style>
        .center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 10vh;
            /* Adjust the height as needed */
        }
    </style>
</head>


<script>

    function imprimir() {
        var divToPrint = document.getElementById("ConsutaBPM");

        // Exclude the "Details" column from printing
        var table = divToPrint.querySelector("table");
        var columnIndex = 8; // Index of the "Details" column (zero-based)
        var cellsToHide = table.querySelectorAll("td:nth-child(" + (columnIndex + 1) + ")");
        var headerToHide = table.querySelector("th:nth-child(" + (columnIndex + 1) + ")");

        for (var i = 0; i < cellsToHide.length; i++) {
            cellsToHide[i].style.display = "none";
        }

        headerToHide.style.display = "none";

        var newWin = window.open("", "_blank");
        newWin.document.write('<html><head><title>Print</title></head><body>');
        newWin.document.write(divToPrint.outerHTML);
        newWin.document.write('</body></html>');
        newWin.document.close();
        newWin.print();
        newWin.close();

        // Reset the display property of the "Details" column and its cells
        for (var i = 0; i < cellsToHide.length; i++) {
            cellsToHide[i].style.display = "";
        }

        headerToHide.style.display = "";
    }

    function goBack() {
        window.history.back();
    }

    $('button').on('click', function () {
        imprimir();
    })

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
                    <i class=""></i>Reports / Orders
                </li>
            </ol>
        </nav>

        <!--tabel-->
        <div class="mt-3" id="ConsutaBPM">
            <h2>List Orders</h2>
            <div class="table-responsive">
                <table class="table" border="1" cellpadding="4">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Customer Name</th>
                            <th>Product Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Postal Code</th>
                            <th>Kode Pesanan</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahOrders == 0) {
                            ?>
                            <tr>
                                <td class="colspan-2">Data Kosong</td>
                            </tr>
                        <?php } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryOrders)) {
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
                                        <?php if ($data['status_pesanan'] === 'delivered' || 'complete') : echo 'Delivered';
                                        endif; ?>
                                    </td>
                                    <td><a href="orders-detail.php?p=<?php echo $data['id']; ?>" style="margin-right: 20px;">
                                            <i class='btn btn-info fas fa-search'></i></a>

                                        <!-- <a href="javascript:void(0);" onclick="deleteItem(<?php echo $data['id']; ?>)">
                                            <i class='btn btn-delete fas fa-trash-alt'></i></a> -->
                                    </td>
                                </tr>
                                <?php
                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="center">
        <button onclick="goBack()" class="warna4" style="font-size: 20px; padding: 5px 20px; margin-right: 20px;">Go
            Back</button>
        <button onclick="imprimir()" class="warna2" style="font-size: 20px; padding: 5px 20px;">Print Table</button>
    </div>
</body>

</html>