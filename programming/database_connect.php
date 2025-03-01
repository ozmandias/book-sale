<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "book_store";

    $message = "";

    // $connection = mysqli_connect($servername, $username, $password, $dbname);
    $connection = new mysqli($servername, $username, $password, $dbname);
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // echo "Connected!";
?>