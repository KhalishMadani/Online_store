<?php 
require "../connection.php";

session_start();
$customerName = $_SESSION['username'];

$query =mysqli_query($conn, "SELECT * FROM customer WHERE username = '$customerName'");
$data = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
    <title>Edit Profile</title>
</head>

<style>
    .no-decoration {
        text-decoration: none;
    }

    form div {
        margin-bottom: 10px;
    }
</style>

<body>
    <div class="container mt-5">
        <h3>Edit User Data User Kamu</h3>
        <form action="" method="post">
            <div>
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="<?php echo $data['nama'] ?>" >
            </div>
            <div>
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="<?php echo $data['alamat'] ?>" >
            </div>
            <div>
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" placeholder="<?php echo $data['kota'] ?>" >
            </div>
            <div>
                <label for="kode_pos">Kode</label>
                <input type="number" class="form-control" id="kode_pos" name="kode_pos" placeholder="<?php echo $data['kode_pos'] ?>" >
            </div>

            <div>
                <button class="btn btn-primary mt-5" type="submit" name="simpan">Save</button>
            </div>
        </form>

        <?php if (isset($_POST['simpan'])) {
            $nama = !empty($_POST['nama']) ? htmlspecialchars($_POST['nama']) : $data['nama'];
            $alamat = !empty($_POST['alamat']) ? htmlspecialchars($_POST['alamat']) : $data['alamat'];
            $kota = !empty($_POST['kota']) ? htmlspecialchars($_POST['kota']) : $data['kota'];
            $kode_pos = !empty($_POST['kode_pos']) ? htmlspecialchars($_POST['kode_pos']) : $data['kode_pos'];
            
            $queryUpdate = "UPDATE customer SET nama ='$nama', alamat ='$alamat', kota ='$kota', kode_pos='$kode_pos' WHERE username = '$customerName'";
            
            if (mysqli_query($conn, $queryUpdate)) {
                echo "Edit Berhasil";
            } else {
                echo "Error";
            }
        }
            ?>
    </div>
</body>
</html>