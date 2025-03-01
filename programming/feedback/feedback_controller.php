<?php
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // include 'connection.php'; // Ensure connection is included

    function create_feedback_from_order($new_order_id) {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $message = $_POST["message"];
            $order_id = $new_order_id;

            $create_status = false;

            $sql = $connection->prepare("INSERT INTO feedback (name, email, phone, message, order_id) VALUES (?, ?, ?, ?, ?)");
            $sql->bind_param("ssssi", $name, $email, $phone, $message, $order_id);
            if($sql->execute()) {
                $message = "Feedback created successfully!";
                echo $message;

                $create_status = true;
            } else {
                $message = "Error! Could not create Feedback!";
            }
            
            return $create_status;
        }
    }

    function addfeedback() {
        global $connection;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = isset($_POST['name']) ? trim($_POST['name']) : '';
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : ''; // Added phone
            $message = isset($_POST['message']) ? trim($_POST['message']) : '';
    
            if (empty($name) || empty($email) || empty($phone) || empty($message)) {
                echo "<script>alert('All fields are required!'); window.history.back();</script>";
                exit();
            }
    
            $name = mysqli_real_escape_string($connection, $name);
            $email = mysqli_real_escape_string($connection, $email);
            $phone = mysqli_real_escape_string($connection, $phone);
            $message = mysqli_real_escape_string($connection, $message);
    
            $query = "INSERT INTO feedback (name, email, phone, message) VALUES ('$name', '$email', '$phone', '$message')";
            $result = mysqli_query($connection, $query);
    
            if ($result) {
                echo "<script>alert('Feedback added successfully!'); window.location.href='feedback.php';</script>";
                exit();
            } else {
                die("Query Failed: " . mysqli_error($connection));
            }
        }
    }

    function updatefeedback() {
        global $connection;
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fid'])) {
            $fid = intval($_POST['fid']);
            $message = isset($_POST['message']) ? trim($_POST['message']) : '';
            $phone = isset($_POST['phone']) ? trim($_POST['phone']) : ''; // Added phone
    
            if (empty($message) || empty($phone)) {
                echo "<script>alert('Message and phone cannot be empty'); window.history.back();</script>";
                exit();
            }
    
            $message = mysqli_real_escape_string($connection, $message);
            $phone = mysqli_real_escape_string($connection, $phone);
    
            $query = "UPDATE feedback SET message='$message', phone='$phone' WHERE id=$fid";
            $go_query = mysqli_query($connection, $query);
    
            if ($go_query) {
                echo "<script>alert('Feedback successfully updated'); window.location.href='feedback.php';</script>";
                exit();
            } else {
                die("QUERY FAILED: " . mysqli_error($connection));
            }
        }
    }

    function delfeedback() {
        global $connection;
    
        if (isset($_GET['fid'])) {
            $fid = intval($_GET['fid']);
    
            // Delete the feedback entry
            $query = "DELETE FROM feedback WHERE id = $fid";
            $go_query = mysqli_query($connection, $query);
    
            if ($go_query) {
                // Get the highest existing id
                $result = mysqli_query($connection, "SELECT MAX(id) AS max_id FROM feedback");
                $row = mysqli_fetch_assoc($result);
                $new_auto_increment = $row['max_id'] + 1;
    
                // Reset AUTO_INCREMENT only if there are remaining rows
                if ($row['max_id'] !== null) {
                    mysqli_query($connection, "ALTER TABLE feedback AUTO_INCREMENT = $new_auto_increment");
                }
    
                echo "<script>alert('Feedback successfully deleted'); window.location.href='feedback.php';</script>";
                exit();
            } else {
                die("QUERY FAILED: " . mysqli_error($connection));
            }
        }
    }
?>