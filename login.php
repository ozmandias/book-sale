<?php
    include "./programming/database_connect.php";
    include "./programming/user/user_controller.php";

    session_start();

    if(isset($_POST["submit"])) {
        // echo "Login";
        $login_status = login_user();
        if($login_status) {
            if($_SESSION["user_type"] == "Admin") {
                header("Location: ./dashboard.php");
            } else {
                header("Location: ./index.php");
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="icomoon/icomoon.css">
	<link rel="stylesheet" type="text/css" href="css/vendor.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">
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
                        <a href="login.php" class="user-account for-buy"><i
                                class="icon icon-user"></i><span>Account</span></a>
                        <a href="./cart.php" class="cart for-buy"><i class="icon icon-clipboard"></i><span>Cart:(0
                                $)</span></a>

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
                                <li class="menu-item"><a href="all.php" class="nav-link">All Book</a></li>
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

    <main class="d-flex justify-content-center mt-4">
        <div class="login-container">
            <h2>Welcome back!</h2>
            <h3>Login to Your Account</h3>
            <form id="loginForm" action="" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>
                
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
    
                <button type="submit" name="submit">Login</button>
            </form>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </main>

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