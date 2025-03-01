<?php
    include "./programming/database_connect.php";
    include "./programming/html_generator.php";
    include "./programming/user/user_controller.php";
    include "./programming/book/book_controller.php";
    include "./programming/order/order_controller.php";

    if(isset($_POST['btn_add_user'])) {
        $create_status = create_user();
        if($create_status) {
            header("Location: ./user.php");
        }
    } else if(isset($_POST['btn_update_user'])) {
        // echo "Update User";
        $update_status = update_user();
        if($update_status) {
            header("Location: ./user.php");
        }
    } else if(isset($_POST['btn_add_book'])) {
        $create_status = create_book();
        if($create_status) {
            header("Location: ./book.php");
        }
    } else if(isset($_POST['btn_update_book'])) {
        $update_status = update_book();
        if($update_status) {
            header("Location: ./book.php");
        }
    } else if(isset($_POST['btn_add_order'])) {
        $order_data = create_order();
        $create_status = $order_data[1];
        if($create_status) {
            header("Location: ./order.php");
        }
    } else if(isset($_POST['btn_update_order'])) {
        $update_status = update_order();
        if($update_status) {
            header("Location: ./order.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <link rel="stylesheet" href="./css/detail.css">

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
    />
</head>
<body>
    <nav class="navbar navbar-expand-lg pt-3 pb-3">
        <div class="container-fluid ms-4">
            <a class="logo" href="#">
            <div class="col-md-2">
                            <div class="main-logo">
                                <a href="index.php"><img src="images/B.png" alt="logo"></a>
                            </div>
                        </div>
            </a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="./index.php"
                    >Home</a
                >
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./book.php">Books</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./user.php">Users</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./order.php">Orders</a>
                </li>

                <li class="nav-item">
                <a class="nav-link" href="./logout.php"
                    ><i class="bi bi-person-fill"></i>Log Out</a
                >
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div id="main" class="d-flex justify-content-center m-3">
        <div class="detail-container">
            <?php
                if(isset($_GET["type"]) && $_GET["type"] == "user" && $_GET["action"] && $_GET["action"] == "create") {
                    HTML("user_add");
                }
                else if(isset($_GET["type"]) && $_GET["type"] == "user" && $_GET["action"] && $_GET["action"] == "edit") {
                    $user = get_user();
                    HTML("user_edit", $user);
                }
                else if(isset($_GET["type"]) && $_GET["type"] == "book" && $_GET["action"] && $_GET["action"] == "create") {
                    HTML("book_add");
                }
                else if(isset($_GET["type"]) && $_GET["type"] == "book" && $_GET["action"] && $_GET["action"] == "edit") {
                    $book = get_book();
                    HTML("book_edit", $book);
                }
                else if(isset($_GET["type"]) && $_GET["type"] == "order" && $_GET["action"] && $_GET["action"] == "create") {
                    HTML("order_add");
                }
                else if(isset($_GET["type"]) && $_GET["type"] == "order" && $_GET["action"] && $_GET["action"] == "edit") {
                    $order = get_order();
                    HTML("order_edit", $order);
                }
            ?>

            <!-- <img src="harry_potter1.jpg" alt="Book Cover" class="detail-image">
            <div class="details">
                <h2>Harry Potter and the Sorcerer's Stone</h2>
                <p><strong>Author:</strong> J.K. Rowling</p>
                <p><strong>Price:</strong> $10.99</p>
                <p><strong>Quantity:</strong> <input type="number" value="1" min="1" class="quantity-input"></p>
                <div class="btn-container">
                    <button class="btn edit-btn">Edit</button>
                    <button class="btn delete-btn">Delete</button>
                </div>
            </div> -->
        </div>
    </div>
</body>
</html>