<?php
	require "./programming/database_connect.php";
	require "./programming/book/book_controller.php";
	require "./programming/order/order_controller.php";
	require "./programming/feedback/feedback_controller.php";

    session_start();

	if(isset($_POST['btn_place_order'])) {
        $order_data = create_order();
		$create_book_status = $order_data[0];
		$create_book_result_id = $order_data[1];

		$create_feedback_status = false;
		if($_POST["message"]) {
			$create_feedback_status = create_feedback_from_order($create_book_result_id);
		} else {
			$create_feedback_status = true;
		}
        
		if($create_book_status && $create_feedback_status) {
            header("Location: ./all.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('https://www.transparenttextures.com/patterns/old-paper.png');
            background-color: #fdfbf7;
            background-size: cover;
            background-position: center;
            color: #333;
            height: 100vh;
            margin: 0;
        }
        .order-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }
        .order-form {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 400px;
        }
        .order-button {
            margin: 20px 0 0 0;
        }
        h1 {
            text-align: center;
            color: #8b4513;
            font-family: 'Garamond', serif;
        }
        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        input, select, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 8px;
            border: 1px solid #bdbdbd;
            font-size: 16px;
        }
        button {
            background-color: #8b4513;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #5d3311;
        }

        input, select, label {
            margin: 0 0 10px 0 !important;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
	<link rel="stylesheet" type="text/css" href="css/vendor.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
							<?php if($_SESSION["isLoggedIn"] == true): ?>
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
    
    <div class="order-container">
        <form class="order-form" method="POST">
            <h1>📚 Book Order 📚</h1>
    
			<?php
				$books = get_books();
				$cart_book_id = null;
				
				if(isset($_GET["book_id"])) {
					$cart_book_id = $_GET["book_id"];
				}

				echo "<label for='book_id'>Select Book</label>";
				echo "<select id='book_id' name='book_id' required>";
				foreach ($books as $book) {
					if($book["id"] == $cart_book_id) {
						echo "<option value='{$book['id']}' selected>{$book['title']}</option>";
					} else {
						echo "<option value='{$book['id']}'>{$book['title']}</option>";
					}
				}
				echo "</select>";
			?>
    
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1">
    
            <label for="name">Full Name</label>
            <input type="text" id="name" name="name" placeholder="Enter your full name" required>
    
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Enter your email address" required>
    
            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
    
            <label for="address">Shipping Address</label>
            <textarea id="address" name="address" placeholder="Enter your address" rows="3" required></textarea>
    
            <label for="order_date">Deliver Date</label>
            <input type="date" id="order_date" name="order_date">

			<label for="message">Message</label>
            <textarea id="message" name="message" placeholder="Enter your message" rows="3"></textarea>

			<input name='status' type='text' class='form-control' id='status' placeholder='status' value='pending' hidden>
    
            <button class="order-button" name="btn_place_order" type="submit">✨ Place Order ✨</button>
        </form>
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

</body>
</html>