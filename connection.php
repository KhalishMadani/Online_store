<?php

    //create connection
    $conn = mysqli_connect("localhost","root","","online_store");

    //check connection
    if (!$conn) {
        die("Connection failed: ". mysqli_connect_error());
    }
?>