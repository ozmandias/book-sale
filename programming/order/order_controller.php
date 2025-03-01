<?php

    function get_orders() {
        global $connection;

        $sql = $connection->query("SELECT orders.id, book_id, title AS book_title, name, address, email, phone, quantity, order_date, status FROM orders JOIN book ON orders.book_id = book.id ORDER BY id ASC");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);

        $connection->close();

        return $rows;
    }

    function get_order() {
        global $connection;

        $id = $_GET["id"];
        $sql = $connection->query("SELECT orders.id, book_id, title AS book_title, name, address, email, phone, quantity, order_date, status FROM orders JOIN book ON orders.book_id = book.id WHERE orders.id = '$id'");
        $result = $sql->fetch_all(MYSQLI_ASSOC)[0];

        // $connection->close();

        return $result;
    }

    function create_order() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $book_id = $_POST["book_id"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $quantity = $_POST["quantity"];
            $order_date = $_POST["order_date"];
            $status = $_POST["status"];

            $create_status = false;
            $result = null;
    
            $sql = $connection->prepare("INSERT INTO orders (book_id, name, address, email, phone, quantity, order_date, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $sql->bind_param("isssssss", $book_id, $name, $address, $email, $phone, $quantity, $order_date, $status);
            if($sql->execute()) {
                $message = "Order created successfully!";
                echo $message;

                $create_status = true;
                $result = $sql->insert_id;
            } else {
                $message = "Error! Could not create Order!";
            }
    
            // $sql->close();
            // $connection->close();

            return [$create_status, $result];
        }
    }

    function update_order() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"]; //invisible
            $book_id = $_POST["book_id"];
            $name = $_POST["name"];
            $address = $_POST["address"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $quantity = $_POST["quantity"];
            $order_date = $_POST["order_date"];
            $status = $_POST["status"];

            $update_status = false;
    
            $sql = $connection->prepare("UPDATE orders SET book_id = ?, name = ?, address = ?, email = ?, phone = ?, quantity = ?, order_date = ?, status = ? WHERE id = ? ");
            $sql->bind_param("issssssss", $book_id, $name, $address, $email, $phone, $quantity, $order_date, $status, $id);
            if($sql->execute()) {
                $message = "Order updated successfully!";
                echo $message;

                $update_status = true;
            } else {
                $message = "Error! Could not update Order!";
            }
    
            $sql->close();
            $connection->close();

            return $update_status;
        }
    }

    function delete_order() {
        global $connection;

        $id = $_GET["id"];

        $delete_status = false;

        $sql = $connection->query("DELETE FROM orders WHERE id = '$id'");

        if($sql) {
            $message = "Order deleted successfully";
            echo $message;

            $delete_status = true;
        }

        $connection->close();

        return $delete_status;
    }

?>