<?php
session_start();

// Set session variables
$_SESSION['username'] = '';
$_SESSION['level'] = '';

// Access session variables
$username = $_SESSION['username'];
$role = $_SESSION['level'];

function isLoggedIn() {
    return isset($_SESSION['username']);
  }

// Output session variables
// echo "Username: " . $username;
// echo "Role: " . $role;
?>
