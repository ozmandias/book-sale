<?php

    function get_users() {
        global $connection;

        $sql = $connection->query("SELECT id, username, email, password, birthdate, gender, user_type FROM user ORDER BY id DESC");
        $rows = $sql->fetch_all(MYSQLI_ASSOC);

        $connection->close();

        return $rows;
    }

    function get_user() {
        global $connection;

        $id = $_GET["id"];
        $sql = $connection->query("SELECT id, username, email, password, gender, user_type FROM user WHERE id = '$id'");
        $result = $sql->fetch_all(MYSQLI_ASSOC)[0];

        // $connection->close();
        
        return $result;
    }

    function create_user() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $gender = $_POST["gender"];
            $user_type = $_POST["user_type"];
            // echo gettype($gender);
    
            $create_status = false;
            
            $check_sql = $connection->prepare("SELECT  id FROM user WHERE email = ?");
            $check_sql->bind_param("s", $email);
            $check_sql->execute();
            $check_sql->store_result();
    
            if ($check_sql->num_rows > 0) {
                $message = "User exists!";
            } else {
                $sql = $connection->prepare("INSERT INTO user (username, email, password, gender, user_type) VALUES (?, ?, ?, ?, ?)");
                $sql->bind_param("sssss", $username, $email, $password, $gender, $user_type);
                if($sql->execute()){
                    $message = "Account created successfully!";
    
                    $create_status = true;
                } else {
                    $message = "Error! Could not create Account!";
                }
                
                $sql->close();
            }
            echo $message;
    
            $check_sql->close();
            $connection->close();

            return $create_status;
        }
    }

    function update_user() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST["id"]; //invisible
            $username = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $gender = $_POST["gender"];
            $user_type = $_POST["user_type"];
    
            $update_status = false;
            
            $sql = $connection->prepare("UPDATE user SET username = ?, email = ?, password = ?, gender = ?, user_type = ? WHERE id = ? ");
            $sql->bind_param("ssssss", $username, $email, $password, $gender, $user_type, $id);
            if($sql->execute()) {
                $message = "Account updated successfully!";
                echo $message;
    
                $update_status = true;
            } else {
                $message = "Error! Could not update Account!";
            }
    
            $sql->close();
            $connection->close();

            return $update_status;
        }
    }

    function delete_user() {
        global $connection;

        $id = $_GET["id"];

        $delete_status = false;

        $sql = $connection->query("DELETE FROM user WHERE id = '$id'");

        if($sql) {
            $message = "Account deleted successfully";
            echo $message;

            $delete_status = true;
        }

        $connection->close();

        return $delete_status;
    }

    function login_user() {
        global $connection;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $login_status = false;
            
            $sql = $connection->prepare("SELECT  id, username, password, user_type FROM user WHERE email = ?");
            $sql->bind_param("s", $email);
            $sql->execute();
            $sql->store_result();
    
            if ($sql->num_rows > 0) {
                $sql->bind_result($result_id, $result_username, $result_password, $result_user_type);
                $sql->fetch();
    
                echo $result_id;
                echo $result_username;
                echo $result_password;
                echo $result_user_type;
                if ($password === $result_password) {
                    $message = "Login successful";
    
                    // Start the session and redirect to the dashboard or home page
                    session_start();
                    $_SESSION['id'] = $result_id;
                    $_SESSION['username'] = $result_username;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_type'] = $result_user_type;
                    $_SESSION['isLoggedIn'] = true;

                    $login_status = true;
                } else {
                    $message = "Incorrect password";
                }
            } else {
                $message = "Email not found";
            }
            echo $message;
    
            $sql->close();
            $connection->close();

            return $login_status;
        }
    }

    function logout_user() {
        $logout_status = false;

        session_start();
        $_SESSION['id'] = null;
        $_SESSION['username'] = null;
        $_SESSION['email'] = null;
        $_SESSION['user_type'] = null;
        $_SESSION['isLoggedIn'] = false;

        $message = "Logout successful";
        echo $message;

        $logout_status = true;

        return $logout_status;
    }

?>