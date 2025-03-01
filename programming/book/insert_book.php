<?php
include 'db_connect.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $author = $_POST["author"];
    $price = $_POST["price"];
    $stock = $_POST["stock"];
    $category_id = $_POST["category_id"];
    $description = $_POST["description"];

    // Insert query
    $sql = "INSERT INTO books (title, author, price, stock, category_id, description) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdiis", $title, $author, $price, $stock, $category_id, $description);

    if ($stmt->execute()) {
        echo "New book added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!-- HTML Form to Add Books -->
<form method="POST" action="insert_book.php">
    Title: <input type="text" name="title" required><br>
    Author: <input type="text" name="author" required><br>
    Price: <input type="number" step="0.01" name="price" required><br>
    Stock: <input type="number" name="stock" required><br>
    Category ID: <input type="number" name="category_id"><br>
    Description: <textarea name="description"></textarea><br>
    <input type="submit" value="Add Book">
</form>
