<?php
    include "./programming/database_connect.php";
    include "./programming/html_generator.php";
    include "./programming/book/book_controller.php";

    if(isset($_GET["action"]) && $_GET["action"] == "delete") {
        $delete_status = delete_book();
        if($delete_status) {
          header("Location: ./book.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List</title>

    <link rel="stylesheet" href="./css/list_page.css" />

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
  
    <div id="main" class="mx-5">
      <div class="m-5">
        <div class=" d-flex justify-content-between me-5">
          <div class="heading">
            <h1 class="fw-bold">List</h1>
            <button class="btn btn-info text-white" onclick="add_book()">Add</button>
          </div>

          <div class="btns">
            <a href="./dashboard.php" class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover me-2">Dashboard</a>
            <a href="./book.php" class="btn add-book-btn btn-primary me-2">
              <i class="bi bi-book pe-2"></i>Books
            </a>
            <a href="./user.php" class="btn add-user-btn btn-primary me-2">
              <i class="bi bi-person-lines-fill pe-2"></i>Users
            </a>
            <a href="./order.php" class="btn add-user-btn btn-primary">
              <i class="bi bi-box-seam pe-2"></i>Orders
            </a>
          </div>
        </div>

        <table class="table table-bordered mt-3">
          <thead>
            <tr class="bg-black">
              <th scope="col">Id</th>
              <th scope="col">Cover Image</th>
              <th scope="col">Title</th>
              <th scope="col">Author</th>
              <th scope="col">Price</th>
              <th scope="col">Stock</th>
              <th scope="col">Description</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>
              <?php
                  $books = get_books();

                  foreach ($books as $book) {
                    HTML("book_list", $book);
                  }
              ?>
          </tbody>
        </table>
      </div>
    </div>

    <script src="./programming/book/book_script.js"></script>
</body>
</html>