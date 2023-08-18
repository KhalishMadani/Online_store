<?php
session_start();
require "../connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    $ExistedUsername = "SELECT COUNT(*) FROM users WHERE username = '$username'";
    $hasil = mysqli_query($conn, $ExistedUsername);
    $fetchRow = mysqli_fetch_row($hasil);

    if ($fetchRow[0] > 0) {
        $_SESSION['username_error_message'] = "Username telah tersedia";
    } else if ($password != $password2) {
        $_SESSION['password_error_message'] = "Password yang anda inputkan tidak sama";
    } else {
        //jika password 1&2 sama maka save ke tabel user
        $query = "INSERT INTO users (username, password, level) VALUES ('$username', '$password2', 'customer')";
        mysqli_query($conn, $query);

        // Retrieve the inserted user_id
        $user_id = mysqli_insert_id($conn);

        // customer data
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $kota = $_POST['kota'];
        $kode_pos = $_POST['kode_pos'];

        // Set the success message in a session variable
        $_SESSION['success_message'] = "Akun anda berhasil dibuat, silakan login";

        // insert ke table customer
        $query = "INSERT INTO customer (user_id, username, nama, alamat, kota, kode_pos) VALUES ($user_id, '$username', '$nama', '$alamat', '$kota', '$kode_pos')";
        mysqli_query($conn, $query); // Execute the query and handle any errors

        // Redirect the user to the appropriate page
        header('Location: ../session/login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../bootstrap-5/css/bootstrap.min.css">
    <script src="../bootstrap-5/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome-6/js/all.min.js"></script>
    <link rel="stylesheet" href="../fontawesome-6/css/fontawesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Create User</title>
</head>


<body>
    <style>
        @media (min-width: 1080px) {
            .h-custom {
                height: 120vh !important;
            }
        }
    </style>
    <section class="h-100 h-custom" style="background-color: #8fc4b7;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">

                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2">Registration Info</h3>

                            <form class="px-md-2" action="create-user.php" method="POST">

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="username">Username</label>
                                    <input type="text" id="username" name="username" class="form-control" required />

                                    <?php if (isset($_SESSION['username_error_message'])): ?>
                                        <p class="text-danger"><?php echo $_SESSION['username_error_message']; ?></p>
                                        <?php unset($_SESSION['username_error_message']); ?>
                                    <?php endif; ?>

                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="password2">Konfirmasi Ulang Password Anda</label>
                                    <input type="password" id="password2" name="password2" class="form-control" required />

                                    <?php if (isset($_SESSION['password_error_message'])): ?>
                                        <p class="text-danger"><?php echo $_SESSION['password_error_message']; ?></p>
                                        <?php unset($_SESSION['password_error_message']); ?>
                                    <?php endif; ?>

                                </div>


                                <div class="form-outline mb-4">
                                    <label class="form-label" for="nama">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" class="form-control" required />
                                </div>

                                <div class="form-outline mb-4">
                                    <label class="form-label" for="alamat">Alamat</label>
                                    <input type="text" id="alamat" name="alamat" class="form-control"
                                        required />
                                </div>

                                <div class="form-outline">
                                    <label class="form-label" for="kode_pos">Kode Pos</label>
                                    <input type="text" id="kode_pos" name="kode_pos" class="form-control" required />
                                </div>

                                <select name="kota" id="kota" class="form-select mt-5"
                                    aria-label="Default select example" required>
                                    <option selected aria-placeholder="pilih kota"> Kota</option>
                                    <option value="Banjarmasin">Banjarmasin</option>
                                    <option value="Banjarbaru">Banjarbaru</option>
                                </select>

                                <button type="submit" class="btn btn-success btn-lg mt-4">Submit</button>

                            </form>

                        </div>

                        <h5 style="text-align: center;">sudah punya user account?</h5>
                        <a href="../session/login.php" class="btn btn-warning warna3 mt-3">
                            <strong style="color: white;">Login</strong></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>