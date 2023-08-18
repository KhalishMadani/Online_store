<?php 
	require "../connection.php";
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
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

				<?php
				if (isset($_POST['loginbtn'])) {
					$username = htmlspecialchars($_POST['username']);
					$password = htmlspecialchars($_POST['password']);

					$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
					$countdata = mysqli_num_rows($query);
					$data = mysqli_fetch_array($query);

					if ($countdata>0) {
						if (password_verify($password, $data['password'])) {
							$_SESSION['username'] = $data['username'];
							$_SESSION['login'] = true;
							header('location: index.php');

						} else {
							echo "passowrd salah";
						}
					} else {
						echo "Akun tidak tersedia";
					}
				}
				?>
			</form>
		</div>
	</body>
</html>