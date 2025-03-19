<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    include './programming/feedback/connection.php';
    require_once './programming/feedback/feedback_controller.php';

	session_start();

    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'delete' && isset($_GET['fid'])) {
            delfeedback($_GET['fid']);
        } elseif ($_GET['action'] == 'edit' && isset($_GET['fid'])) {
            $fid = intval($_GET['fid']);
            $query = "SELECT * FROM feedback WHERE id = $fid";
            $go_query = mysqli_query($connection, $query);
            $feedback = mysqli_fetch_assoc($go_query);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Book Sale</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="format-detection" content="telephone=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="author" content="">
	<meta name="keywords" content="">
	<meta name="description" content="">

    <style>
        body {
            background-color: #ADD8E6;
            color: white;
        }
        .container {
            max-width: 1680px;
            height: 100vh;
        }
        .card {
            background-color: white;
        }
        .table {
            background-color: white;
        }
        .table td, .table th {
            color: black;
        }
        .table th {
            background-color: #0056b3;
            color: white;
        }
        .navbar {
            background-color: #f3f2ec;
            padding-left: 4rem;
            padding-right: 4rem;
        }
        ul.navbar-nav.mx-auto.mb-2.mb-lg-0 {
            margin-right: 10% !important;
        }
        .nav-item {
            padding-left: 20px;
            font-size: 18px;
            font-weight: 600;
        }
        
        .nav-link {
            color: #fff;
            font-size: 18px;
        }
        
        .nav-link.active,
        .nav-link:hover {
            color: #47b2e4 !important;
        }

        .btn-primary{
            background-color: #47b2e4 !important;
            border-color: #47b2e4 !important;
        }

        .btn-write {
            background-color: #17a2b8 !important;
            color: #ffffff !important;
            height: 50px;
            border-radius: 5px !important;
        }

        .add-book-btn, .add-user-btn{
            box-shadow: 0 3px 8px black;
        }
    </style>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
	<link rel="stylesheet" type="text/css" href="css/vendor.css">
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

	<div class="header-wrap">
		<div class="top-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="social-links">
							<ul>
								<li>
									<a href="#"><i class="icon icon-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-youtube-play"></i></a>
								</li>
								<li>
									<a href="#"><i class="icon icon-behance-square"></i></a>
								</li>
							</ul>
						</div><!--social-links-->
					</div>
					<div class="col-md-6">
						<div class="right-element">
							<?php if($_SESSION["isLoggedIn"] && $_SESSION["isLoggedIn"] == true): ?>
								<?php if($_SESSION["user_type"] == "Admin"):?>
									<a href="dashboard.php" class="user-account for-buy"><span>Dashboard</span></a>
								<?php else: ?>
									<a href="" class="user-account for-buy dropdown-toggle" data-bs-toggle="dropdown"><span><?php $username = $_SESSION["username"]; echo $username; ?></span></a>
									<ul class="dropdown-menu">
										<li><a class="dropdown-item" href="./logout.php">Log Out</a></li>
									</ul>
								<?php endif; ?>
							<?php else: ?>
								<a href="login.php" class="user-account for-buy"><i
										class="icon icon-user"></i><span>Account</span></a>
							<?php endif; ?>

							<a href="./cart.php" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0
									$)</span></a>

							<!--<div class="action-menu">

								<div class="search-bar">
									<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
										<i class="icon icon-search"></i>
									</a>
									<form role="search" method="get" class="search-box">
										<input class="search-field text search-input" placeholder="Search"
											type="search">
									</form>
								</div>
							</div>-->

						</div><!--top-right-->
					</div>

				</div>
			</div>
		</div><!--top-content-->

		<header id="header">
			<div class="container-fluid">
				<div class="row">

					<div class="col-md-2">
						<div class="main-logo">
							<a href="index.php"><img src="images/B.png" alt="logo"></a>
						</div>

					</div>

					<div class="col-md-10">

						<nav id="navbar">
							<div class="main-menu stellarnav">
								<ul class="menu-list">
									<li class="menu-item active"><a href="index.php">Home</a></li>
									<li class="menu-item has-sub">
										<!--<a href="#pages" class="nav-link">Pages</a>

										<ul>
											<li class="active"><a href="index.php">Home</a></li>
											<li><a href="index.php">About</a></li>
											<li><a href="index.php">Styles</a></li>
											<li><a href="index.php">Blog</a></li>
											<li><a href="index.php">Post Single</a></li>
											<li><a href="index.php">Our Store</a></li>
											<li><a href="index.php">Product Single</a></li>
											<li><a href="index.php">Contact</a></li>
											<li><a href="index.php">Thank You</a></li>
										</ul>
										-->

									</li>
									<li class="menu-item"><a href="all.php" class="nav-link">All Books</a></li>
									<li class="menu-item"><a href="review.php" class="nav-link">Feedback</a></li>
									<!-- <li class="menu-item"><a href="#popular-books" class="nav-link">Popular</a></li>
									<li class="menu-item"><a href="#special-offer" class="nav-link">Offer</a></li> -->
									</ul>

								<div class="hamburger">
									<span class="bar"></span>
									<span class="bar"></span>
									<span class="bar"></span>
								</div>

							</div>
						</nav>

					</div>

				</div>
			</div>
		</header>
	</div><!--header-wrap-->

    <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <button class="btn btn-write" onclick="write_to_page()">Write</button>
                <div class="card">
                    <div class="card-header text-center text-white" style="background-color: #17A2B8;">
                        <h4>Customer Feedback</h4>
                    </div>
                    <div class="card-body">
                        <!-- Feedback List -->
                        <table class="table table-striped table-bordered mt-4">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <!-- <th>Phone</th> -->
                                    <th>Message</th>
                                    <!-- <th>Order ID</th> -->
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM feedback ORDER BY id ASC";
                                $go_query = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($go_query)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                    // echo "<td>" . htmlspecialchars($row['phone']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['message']) . "</td>";
                                    // echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                                    /*echo "<td>
                                            <a href='feedback.php?action=edit&fid={$row['id']}' class='btn btn-outline-primary btn-sm'>Edit</a>
                                            <a href='feedback.php?action=delete&fid={$row['id']}' class='btn btn-outline-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                                        </td>";*/
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
    </div>
	
	<footer id="footer">
		<div class="container">
			<div class="row">

				<div class="col-md-4">

					<div class="footer-item">
						<div class="company-brand">
							<div class="main-logo">
								<a href="index.php"><img src="images/B.png" alt="logo"></a>
							</div>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sagittis sed ptibus
								liberolectus
								nonet psryroin. Amet sed lorem posuere sit iaculis amet, ac urna. Adipiscing fames
								semper erat ac in suspendisse iaculis.</p>
						</div>
					</div>

				</div>

				<div class="col-md-2">

					<div class="footer-menu">
						<h5>About Us</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">vision</a>
							</li>
							<li class="menu-item">
								<a href="#">articles </a>
							</li>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>Discover</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="index.php">Home</a>
							</li>
							<li class="menu-item">
								<a href="#">Books</a>
							</li>
							<li class="menu-item">
								<a href="#">Authors</a>
							</li>


						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>My account</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a href="#">Sign In</a>
							</li>
							<li class="menu-item">
								<a href="#">View Cart</a>
							</li>
							<li class="menu-item">
								<a href="#">Track My Order</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>Help</h5>
						<ul class="menu-list">

							<li class="menu-item">
								<a href="#">Contact us</a>
							</li>
						</ul>
					</div>

				</div>

			</div>
			<!-- / row -->

		</div>
	</footer>

	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="copyright">
						<div class="row">

							<div class="col-md-6">
								<p>© 2025 Copy rights
									<a href="#" target="_blank">Book Sale</a>
								</p>
							</div>

							<div class="col-md-6">
								<div class="social-links align-right">
									<ul>
										<li>
											<a href="#"><i class="icon icon-facebook"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-twitter"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-youtube-play"></i></a>
										</li>
										<li>
											<a href="#"><i class="icon icon-behance-square"></i></a>
										</li>
									</ul>
								</div>
							</div>

						</div>
					</div><!--grid-->

				</div><!--footer-bottom-content-->
			</div>
		</div>
	</div>

	<script src="js/jquery-1.11.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
		crossorigin="anonymous"></script>
	<script src="js/plugins.js"></script>
	<script src="js/script.js"></script>
    <script src="./programming/review_script.js"></script>

</body>

</html>