<?php

    function get_books() {
        global $connection;

        $sql = $connection->query("SELECT book.id, title, category_id, category_name, author_id, author_name, price, stock, description, category_id, cover_image FROM book JOIN category ON book.category_id = category.id JOIN author ON book.author_id = author.id ORDER BY id ASC");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);

        // $connection->close();

        return $rows;
    }

    function get_book() {
        global $connection;

        $id = $_GET["id"];
        $sql = $connection->query("SELECT book.id, title, author_id, author_name, price, stock, description, category_id, cover_image FROM book JOIN author ON book.author_id = author.id WHERE book.id = '$id'");
        $result = $sql->fetch_all(MYSQLI_ASSOC)[0];

        // $connection->close();

        return $result;
    }

    function create_book() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];
            $description = $_POST["description"];
            $cover_image = null /*$_POST["cover_image"]*/;
            $category = $_POST["category"];
            $author = $_POST["author"];
            $price = $_POST["price"];
            $stock = $_POST["stock"];

            // echo $_FILES["cover_image"];
            if(isset($_FILES["cover_image"]) && $_FILES["cover_image"]["error"] == 0) {
                $cover_image = $_FILES["cover_image"]["tmp_name"];
                $cover_image = file_get_contents($cover_image);
            }
            // echo $cover_image;

            $create_status = false;
    
            $sql = $connection->prepare("INSERT INTO book (title, description, cover_image, category_id, author_id, price, stock) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $sql->bind_param("sssiiss", $title, $description, $cover_image, $category, $author, $price, $stock);
            if($sql->execute()) {
                $message = "Book created successfully!";
                echo $message;

                $create_status = true;
            } else {
                $message = "Error! Could not create Book!";
            }
    
            $sql->close();
            $connection->close();

            return $create_status;
        }
    }

    function update_book() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"]; //invisible
            $title = $_POST["title"];
            $description = $_POST["description"];
            $cover_image = null /*$_POST["cover_image"]*/;
            $category = $_POST["category"];
            $author = $_POST["author"];
            $price = $_POST["price"];
            $stock = $_POST["stock"];

            // echo $_FILES["cover_image"];
            if(isset($_FILES["cover_image"]) && $_FILES["cover_image"]["error"] == 0) {
                $cover_image = $_FILES["cover_image"]["tmp_name"];
                $cover_image = file_get_contents($cover_image);
            }
            // echo $cover_image;

            $update_status = false;
    
            $sql = $connection->prepare("UPDATE book SET title = ?, description = ?, cover_image = ?, category_id = ?, author_id = ?, price = ?, stock = ? WHERE id = ? ");
            $sql->bind_param("sssiisss", $title, $description, $cover_image, $category, $author, $price, $stock, $id);
            if($sql->execute()) {
                $message = "Book updated successfully!";
                echo $message;

                $update_status = true;
            } else {
                $message = "Error! Could not update Book!";
            }
    
            $sql->close();
            $connection->close();

            return $update_status;
        }
    }

    function delete_book() {
        global $connection;

        $id = $_GET["id"];

        $delete_status = false;

        $sql = $connection->query("DELETE FROM book WHERE id = '$id'");

        if($sql) {
            $message = "Book deleted successfully";
            echo $message;

            $delete_status = true;
        }

        $connection->close();

        return $delete_status;
    }

?>