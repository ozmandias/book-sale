<?php
include 'db_connect.php';

// Fetch all books
$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book List</title>
</head>
<body>
    <h2>Book List</h2>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Author</th>
            <th>Price</th>
            <th>Stock</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['book_id']}</td>
                        <td>{$row['title']}</td>
                        <td>{$row['author']}</td>
                        <td>\${$row['price']}</td>
                        <td>{$row['stock']}</td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No books found</td></tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close();
?>
