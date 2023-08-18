<?php
session_start();

// Set session variables
$_SESSION['username'] = 'admin';
$_SESSION['level'] = 'admin';

// Access session variables
$username = $_SESSION['username'];
$role = $_SESSION['level'];


// Output session variables
// echo "Username: " . $username;
// echo "Role: " . $role;
?>
