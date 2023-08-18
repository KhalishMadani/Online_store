<?php
require "../connection.php";
require "../session/session.php";
require "navbar.php";

$id = $_GET['p'];
$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id = b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$data[kategori_id]'");

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characterslength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $characterslength - 1)];
    }
    return $randomString;
}
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
    <title>Produk Detail</title>
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
    <!-- Div untuk detail Produk -->
    <div class="container mt-5">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="index.php" class="no-decoration text-muted"><i
                            class="fa-solid fa-house fa-bounce me-1"></i>Home
                </li></a>
                <li class="breadcrumb-item active" aria-current="page">
                    <i class=""></i>Produk Detail
                </li>
            </ol>
        </nav>

        <!-- Div untuk edit produk-->
        <div class="my-5 col-12 col-md-5">
            <h3>Detail Produk</h3>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="nama" placeholder="<?php echo $data['nama']; ?>"
                        class="form-control">
                </div>

                <!-- div menampilkan variabel nama dg mengakses tabel kategori-->
                <div>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori" class="form-control">
                        <option value="<?php echo $data['kategori_id']; ?>"> <?php echo $data['nama_kategori']; ?>
                        </option>
                        <?php
                        while ($datakategori = mysqli_fetch_array($queryKategori)) {
                            ?>
                            <option value="<?php echo $datakategori['id']; ?>"><?php echo $datakategori['nama']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div>
                    <label for="harga">Harga</label>
                    <input type="number" id="harga" name="harga" placeholder="<?php echo "Rp." . $data['harga']; ?>"
                        class="form-control">
                </div>

                <div>
                    <label for="currentfoto">Foto Produk Saat Ini</label>
                    <img src="../images/<?php echo $data['foto']; ?>" alt="" width="300px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" class='form-control'>
                </div>

                <div>
                    <label for="detail">Detail Barang</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"
                        placeholder="<?php echo $data['detail']; ?>"></textarea>
                </div>

                <div>
                    <label for="stok">Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <?php
                        $selected_option = $data['ketersediaan_stok'];
                        $options = ['tersedia', 'habis'];
                        foreach ($options as $option) {
                            $selected = ($option == $selected_option) ? 'selected' : '';
                            echo "<option value='$option' $selected>$option</option>";
                        }
                        ?>
                    </select>
                </div>

                <div>
                    <button class="btn btn-primary mt-5" type="submit" name="simpan">Simpan Perubahan</button>
                </div>
            </form>

            <?php if (isset($_POST['simpan'])) {
                $nama = !empty($_POST['nama']) ? htmlspecialchars($_POST['nama']) : $data['nama'];
                $kategori = !empty($_POST['kategori']) ? htmlspecialchars($_POST['kategori']) : $data['kategori'];
                $harga = !empty($_POST['harga']) ? htmlspecialchars($_POST['harga']) : $data['harga'];
                $detail = !empty($_POST['detail']) ? htmlspecialchars($_POST['detail']) : $data['detail'];
                $ketersediaan_stok = !empty($_POST['ketersediaan_stok']) ? htmlspecialchars($_POST['ketersediaan_stok']) : $data['ketersediaan_stok'];

                //variabel untuk tipe file foto
                $target_dir = "../images/";
                $nama_file = basename($_FILES['foto']['name']);
                $image_size = $_FILES['foto']['size'];

                if ($nama_file) {
                    $target_file = $target_dir . $nama_file;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                    $random_name = generateRandomString(13);
                    $new_name = $random_name . "." . $imageFileType;

                    if ($image_size > 10000000) {
                        echo "File tidak boleh lebih dari 500kb";
                    } elseif ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                        echo "File wajib bertipe JPG, JPEG, PNG, atau GIF";
                    } else {
                        move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
                        //command to update data table with new image
                        $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', harga = '$harga', foto = '$new_name', detail = '$detail', ketersediaan_stok = '$ketersediaan_stok' WHERE id = $id");
                    }
                } else {
                    //command to update data table without changing the image
                    $queryUpdate = mysqli_query($conn, "UPDATE produk SET kategori_id = '$kategori', nama = '$nama', harga = '$harga', detail = '$detail', ketersediaan_stok = '$ketersediaan_stok' WHERE id = $id");
                }

                if ($queryUpdate) {
                    echo "Berhasil Mengubah Data";
                } else {
                    echo mysqli_error($conn);
                }

            }
            ?>
        </div>
    </div>
</body>

</html>