<?php
require "../connection.php";
require "../session/session.php";
require "navbar.php";

$id = $_GET['p'];
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
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

    <!-- Div untuk detail kategori -->
    <div class="container mt-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i
                            class="fa-solid fa-house fa-bounce me-1"></i>Home
                </li></a>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class=""></i>Kategori Detail
                </li>
            </ol>
        </nav>

        <!-- Div untuk edit kategori -->
        <div class="my-5 col-12 col-md-5">
            <h3>Detail Kategori</h3>

            <form action="" method="post">
                <div>
                    <label for="kategori">Edit</label>
                    <input type="text" id="kategori" name="kategori" placeholder="<?php echo $data['nama']; ?>"
                        class="form-control">
                </div>
                <div class="mt-2">
                    <button class="btn btn-primary" type="submit" name="simpan_edit">OK</button>
                </div>
            </form>

            <!-- kondisi apabila nama kategori yg di update mengalami kesamaan data -->
            <?php if (isset($_POST['simpan_edit'])) {
                $kategori = htmlspecialchars($_POST['kategori']);

                $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$kategori'");

                $totalKategori = mysqli_num_rows($queryExist);

                if ($totalKategori > 0) { ?>
                    <div class="alert alert-danger" role="alert"> Kategori Sudah Tersedia </div>

                <?php } else {
                    $queryUpdate = mysqli_query($conn, "UPDATE kategori SET nama='$kategori' WHERE id='$id'");


                    if ($queryUpdate) { ?>
                        <div class="alert alert-primary" role="alert">Kategori Berhasil di Edit </div>
                        <meta http-equiv="refresh" content="10; url=kategori.php" />

                        <?php
                    } else {
                        echo mysqli_error($conn);
                    }
                }
            }
            ?>
        </div>
    </div>


</body>

</html>