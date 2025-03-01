<?php
    include "./programming/database_connect.php";
    include "./programming/user/user_controller.php";

    $logout_status = logout_user();
    if($logout_status) {
        header("Location: ./index.php");
    }
?>