<?php
	include "./programming/database_connect.php";
	include "./programming/html_generator.php";
	include "./programming/book/book_controller.php";

	session_start();
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
									<a><i class="icon icon-facebook"></i></a>
								</li>
								<li>
									<a><i class="icon icon-twitter"></i></a>
								</li>
								<li>
									<a><i class="icon icon-youtube-play"></i></a>
								</li>
								<li>
									<a><i class="icon icon-behance-square"></i></a>
								</li>
							</ul>
						</div><!--social-links-->
					</div>
					<div class="col-md-6">
						<div class="right-element">
							<?php if(isset($_SESSION["isLoggedIn"]) && $_SESSION["isLoggedIn"] == true): ?>
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

							<a href="./cart.php" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart</span></a>

							<!--<div class="action-menu">

								<div class="search-bar">
									<a class="search-button search-toggle" data-selector="#header-wrap">
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

	<!-- Write Here -->
	<div class="container my-5">
		<div class="row">
			<div class="col-md-12">
				<div class="section-header align-center">
					<!--<div class="title">
						<span>Some quality items</span>
					</div>-->
					<h2 class="section-title">All Books</h2>
				</div>

				<div class="product-list" data-aos="fade-up">
					<div class="row">
						<?php
							$books = get_books();

							foreach($books as $book) {
								HTML("all_books", $book);
							}
						?>
					</div>
					<!--ft-books-slider-->
				</div><!--grid-->
			</div><!--inner-content-->
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
								<a>vision</a>
							</li>
							<li class="menu-item">
								<a>articles </a>
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
								<a>Books</a>
							</li>
							<li class="menu-item">
								<a>Authors</a>
							</li>


						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>My account</h5>
						<ul class="menu-list">
							<li class="menu-item">
								<a>Sign In</a>
							</li>
							<li class="menu-item">
								<a>View Cart</a>
							</li>
							<li class="menu-item">
								<a>Track My Order</a>
							</li>
						</ul>
					</div>

				</div>
				<div class="col-md-2">

					<div class="footer-menu">
						<h5>Help</h5>
						<ul class="menu-list">

							<li class="menu-item">
								<a>Contact us</a>
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
									<a target="_blank">Book Sale</a>
								</p>
							</div>

							<div class="col-md-6">
								<div class="social-links align-right">
									<ul>
										<li>
											<a><i class="icon icon-facebook"></i></a>
										</li>
										<li>
											<a><i class="icon icon-twitter"></i></a>
										</li>
										<li>
											<a><i class="icon icon-youtube-play"></i></a>
										</li>
										<li>
											<a><i class="icon icon-behance-square"></i></a>
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
	<script src="./programming/cart_script.js"></script>

</body>

</html>