<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css" />

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

    <!-- <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="css/vendor.css">
    <link rel="stylesheet" type="text/css" href="style.css"> -->
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
            <h1 class="fw-bold">Welcome Admin, <?php echo $_SESSION['username']; ?> </h1>
          </div>

          <div class="btns ">
            <a href="./detail.php?type=book&action=create" class="btn add-book-btn btn-primary me-2">
              <i class="bi bi-folder-plus pe-2"></i>Add Book
            </a>
            <a href="./detail.php?type=user&action=create" class="btn add-user-btn btn-primary">
                <i class="bi bi-person-plus-fill pe-2"></i>Add User
              </a>
          </div>
        </div>
      </div>
      <div id="first-row" class="row gap-5 mx-5">
        <div class="card" style="width: 18rem">
          <i class="bi bi-bookmarks-fill"></i>
          <div class="card-body">
            <h5 class="card-title pt-3">Category</h5>

            <a href="./category.php" class="btn btn-primary mb-3 mt-2">View Details</a>
          </div>
        </div>

        <div class="card" style="width: 18rem">
          <i class="bi bi-person-check-fill"></i>
          <div class="card-body">
            <h5 class="card-title pt-3">Author</h5>

            <a href="./author.php" class="btn btn-primary mb-3 mt-2">View Details</a>
          </div>
        </div>

        <div class="card" style="width: 18rem">
          <i class="bi bi-person-fill"></i>
          <div class="card-body">
            <h5 class="card-title pt-3">User</h5>

            <a href="./user.php" class="btn btn-primary mb-3 mt-2">View Details</a>
          </div>
        </div>
      </div>

      <div id="second-row" class="row gap-5 mx-5 mt-5">
        <div class="card" style="width: 18rem">
          <i class="bi bi-book-half"></i>
          <div class="card-body">
            <h5 class="card-title pt-3">Book</h5>

            <a href="./book.php" class="btn btn-primary mb-3 mt-2">View Details</a>
          </div>
        </div>

        <div class="card" style="width: 18rem">
          <i class="bi bi-bag-check-fill"></i>
          <div class="card-body">
            <h5 class="card-title pt-3">Order</h5>

            <a href="./order.php" class="btn btn-primary mb-3 mt-2">View Details</a>
          </div>
        </div>

        <div class="card" style="width: 18rem">
          <i class="bi bi-chat-left-text-fill"></i>
          <div class="card-body">
            <h5 class="card-title pt-3">Feedback</h5>

            <a href="./feedback.php" class="btn btn-primary mb-3 mt-2">View Details</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>