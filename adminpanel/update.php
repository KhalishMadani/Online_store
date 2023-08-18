<?php
require "../session/session.php";
require "../connection.php";
require "navbar.php";


$queryProduk = mysqli_query($conn, "SELECT * FROM produk");
$jumlahProduk = mysqli_num_rows($queryProduk);

$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

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

<style>
    form div {
        margin-bottom: 10px;
    }
</style>

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
    <title>Tambah Produk</title>
</head>

<body>
    <div class="container mt-5">
        <h3>Tambahkan Produk Dibawah</h3>

        <!-- form action-->
        <form action="" method="POST" enctype="multipart/form-data">
            <div>
                <label for="nama">Nama Produk</label>
                <input type="text" id="nama" name="nama" class="form-control" required>
            </div>

            <div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control">
                    <option value="">Pilih Satu</option>
                    <?php
                    while ($data = mysqli_fetch_array($queryKategori)) {
                        ?>
                        <option value="<?php echo $data['id']; ?>">
                            <?php echo $data['nama']; ?></option>
                        <?php
                    } ?>
                </select>
            </div>

            <div>
                <label for="harga">Harga Satuan</label>
                <input type="number" id="harga" name="harga" class="form-control" required>
            </div>

            <div>
                <label for="foto">Tambahkan Foto</label>
                <input type="file" name="foto" class='form-control'>
            </div>

            <div>
                <label for="detail">Detail Barang</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
            </div>

            <div>
                <label for="ketersediaan_stok">Ketersediaan Barang</label>
                <select name="ketersediaan_stok" id="ketersediaan_stok" required>
                    <option value="">choose one option below</option>
                    <option value="tersedia">Tersedia</option>
                    <option value="habis">Habis</option>
                </select>
            </div>

            <div id="stock" style="display: none;">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock-input" readonly>
            </div>

            <div>
                <button class="btn btn-primary" type="submit" name="simpan"> simpan</button>
            </div>
        </form>

        <!-- action-->
        <?php if (isset($_POST['simpan'])) {
            $nama = htmlspecialchars($_POST['nama']);
            $kategori = htmlspecialchars($_POST['kategori']);
            $harga = htmlspecialchars($_POST['harga']);
            $detail = htmlspecialchars($_POST['detail']);
            $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);
            $stock = htmlspecialchars($_POST['stock']);
            $kode_beli = mt_rand(100000, 999999);

            //variabel untuk tipe file foto
            $target_dir = "../images/";
            $nama_file = basename($_FILES['foto']['name']);
            $target_file = $target_dir . $nama_file;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $image_size = $_FILES['foto']['size'];
            $random_name = generateRandomString(13);
            $new_name = $random_name . "." . $imageFileType;

            if ($nama == '' || $kategori == '' || $harga == '') {
                echo "Data Tidak Boleh Kosong";
            } else {
                if ($nama_file != '') {
                    if ($image_size > 5000000) {
                        echo "file tidak boleh lebih dari 500kb";
                    } else {
                        if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg' && $imageFileType != 'gif') {
                            echo "file wajib tertipe jpg atau png atau jpeg atau gif";
                        } else {
                            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $new_name);
                        }
                    }
                }

                //query insert to product table
                $queryTambah = mysqli_query($conn, "INSERT INTO produk (kategori_id, nama, harga, foto, detail, ketersediaan_stok, stock) VALUES ('$kategori', '$nama', '$harga',
                '$new_name', '$detail', '$ketersediaan_stok', '$stock')");

                $queryPrdk = mysqli_query($conn, "INSERT INTO pembelian_prdk (nama, kode_beli, harga, foto, detail, jumlah) VALUES ('$nama','$kode_beli','$harga','$new_name','$detail','$stock')");

                if ($queryTambah) {
                    echo "Berhasil Tersimpan";
                } else {
                    echo mysqli_error($conn);
                }

                if ($queryPrdk) {
                    echo "Berhasil Tersimpan";
                } else {
                    echo mysqli_error($conn);
                }
            }
        }
        ?>
    </div>

    <script>
        var ketersediaanStokSelect = document.getElementById('ketersediaan_stok');
        var stockDiv = document.getElementById('stock');
        var stockInput = document.getElementById('stock-input');

        ketersediaanStokSelect.addEventListener('change', function () {
            if (ketersediaanStokSelect.value === 'tersedia') {
                stockDiv.style.display = 'block';
                stockInput.readOnly = false;
            } else {
                stockDiv.style.display = 'none';
                stockInput.readOnly = true;
            }
        });
    </script>
</body>

</html>