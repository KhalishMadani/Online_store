<?php

session_start();
require "../connection.php";

$error = "";
if (isset($_POST['loginbtn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $queryUser = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    $user = mysqli_fetch_assoc($queryUser);

    if ($user) {
        if ($password === $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['level'] = $user['level'];

            if ($user['level'] === 'admin') {
                header('location: ../adminpanel/index.php');
                exit();
            } else if ($user['level'] === 'customer') {
                header('Location: ../index.php');
                exit();
            } else if ($user['level'] === 'courrier') {
                header('location: ../courrier/index.php');
                exit();
            }
        } else {
            $error = "Wrong password. Please try again.";
        }
    } else {

        $error = "User Not Found. Please Check Your Username";
    }
}

// Check if a success message exists
if (isset($_SESSION['success_message'])) {
    $successMessage = $_SESSION['success_message'];
    // Display the success message in your desired format (e.g., an alert box)
    echo "<script>alert('$successMessage');</script>";
    // Remove the success message from the session
    unset($_SESSION['success_message']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../adminpanel/style.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="login">
        <h1>Login</h1>
        <form action="" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <input type="submit" value="Login" name="loginbtn">
            <a href="../customer_page/create-user.php">Belum Memiliki Akun? Register Sekarang</a>
        </form>
    </div>
    <?php if (!empty($error)): ?>
        <script>
            alert("<?php echo $error; ?>");
        </script>
    <?php endif; ?>
</body>

</html>