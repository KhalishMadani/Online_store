<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";

$queryProduk = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id");
$jumlahProduk = mysqli_num_rows($queryProduk);

if(isset($_GET['filter'])){
    $filter = "SELECT * FROM produk WHERE kategori_id IN (SELECT id FROM kategori WHERE nama LIKE '%" . $_GET['filter'] . "%')";
} else {
    $filter = "SELECT * FROM produk";
}

$filterSearch = mysqli_query($conn,$filter);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
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

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 10vh;
        /* Adjust the height as needed */
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
                    <i class=""></i>Produk
                </li>
            </ol>
        </nav>

        <!-- form isian produk-->
        <div class="my-5 col-12 col-md-5">
            <h3>Tambah Produk</h3>
            <a href="update.php""><button class=" btn btn-success"> tambahkan produk anda</button></a>
        </div>

        <div class="my-5 col-12 col-md-5" >
            <form action="produk.php" method="get" >
                <Label>Filter Nama Produk :</Label>
                <input type="text" class="form-control" name="filter" placeholder="cari kategori barang disini" >
                <button class="btn btn-info" type="submit" >Cari</button>
            </form>
        </div>

        <!-- tabel -->
        <div id="ConsutaBPM" class="mt-3">
            <h2>List Produk</h2>
            <div class="table-responsive">
                <table class="table">

                    <!-- head tabel-->
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status Barang</th>
                            <th>Jumalah Stok</th>
                            <th>Details</th>
                        </tr>
                    </thead>

                    <!-- body tabel-->
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                            echo "data kosong";
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($filterSearch)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $jumlah; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama']; ?>
                                    </td>

                                    <!-- display the category name on product table, instead of id number  -->
                                    <td>
                                        <?php
                                        $kategori_id = $data['kategori_id'];
                                        $query = mysqli_query($conn, "SELECT nama FROM kategori WHERE id='$kategori_id'");
                                        $kategori_data = mysqli_fetch_assoc($query);
                                        $kategori_nama = $kategori_data['nama'];
                                        echo $kategori_nama; ?>
                                    </td>

                                    <td>
                                        <?php echo "Rp." . $data['harga']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['ketersediaan_stok']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['stock']; ?>
                                    </td>
                                    <td><a href="produk-detail.php?p=<?php echo $data['id']; ?>" style="margin-right: 20px;">
                                            <i class='btn btn-info fas fa-search'></i></a>

                                        <a href="javascript:void(0);" onclick="deleteItem(<?php echo $data['id']; ?>)">
                                            <i class='btn btn-delete fas fa-trash-alt'></i></a>
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
    
    <!-- <div class="center">
        <button onclick="goBack()" class="warna4" style="font-size: 20px; padding: 5px 20px; margin-right: 20px;">Go
            Back</button>
        <button onclick="imprimir()" class="warna2" style="font-size: 20px; padding: 5px 20px;">Print Table</button>
    </div> -->
</body>

</html>