
<?php
$conn = new mysqli("localhost", "root", "", "book");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
