<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            xhr.open("GET", "delete-kategori.php?p=" + itemId, true);
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
                    <i class=""></i>Kategori
                </li>
            </ol>
        </nav>
        
        <!-- isian tambah kategori -->
        <div class="my-5 col-12 col-md-5">
            <h3>Tambah Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori"
                        class="form-control">
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>

            <!-- action -->
            <?php if (isset($_POST['simpan_kategori'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");

                $jumlahKategoribaru = mysqli_num_rows($queryExist);

                if ($jumlahKategoribaru > 0) { ?>
                    <div class="alert alert-danger" role="alert">Kategori Sudah Tersedia </div>

                <?php } else {
                    $querySimpan = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$kategori')");

                    if ($querySimpan) { ?>
                        <div class="alert alert-primary" role="alert"> Berhasil </div>
                        <meta http-equiv="refresh" content="4; url=kategori.php" />

                        <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>
        </div>

        <!--tabel-->
        <div class="mt-3">
            <h2>List Kategori</h2>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                            ?>
                            <tr>
                                <td class="colspan-2">Data Kosong</td>
                            </tr>
                        <?php } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $jumlah; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['nama']; ?>
                                    </td>
                                    <td><a href="kategori-detail.php?p=<?php echo $data['id']; ?>" style="margin-right: 20px;">
                                            <i class='btn btn-info fas fa-search'></i></a>

                                        <a href="javascript:void(0);" onclick="deleteItem(<?php echo $data['id']; ?>)">
                                            <i class='btn btn-delete fas fa-trash-alt'></i></a>
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
</body>

</html>