<?php
$host = "localhost";
$user = "root"; // Change if your DB uses a different username
$pass = ""; // Change if your DB has a password
$dbname = "book_store"; // Replace with your actual database name

$connection = mysqli_connect($host, $user, $pass, $dbname);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>