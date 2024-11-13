<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kiểm tra nếu người dùng đã đăng nhập
$userLoggedIn = isset($_SESSION['user']);
if ($userLoggedIn) {
    $user = $_SESSION['user']; // Lấy thông tin người dùng đã đăng nhập
} else {
    $user = null; // Không có thông tin người dùng nếu chưa đăng nhập
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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

    <link rel="stylesheet" type="text/css" href="assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="assets/icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="assets/css/vendor.css">
    <link rel="stylesheet" type="text/css" href="assets/style.css">

    <title>BookSaw - Free Book Store HTML CSS Template</title>
</head>
<body>
<div id="header-wrap">
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
					<div class="right-element d-flex justify-content-between align-items-center">
						<!-- Account Section -->
						<a href="#" class="user-account for-buy d-flex align-items-center">
							<i class="icon icon-user"></i>
								<p class="mb-0 ms-1">
									<?php 
										echo isset($user) && !empty($user['FullName']) ? htmlspecialchars($user['FullName']) : 'Guest';
									?>
								</p> <!-- Thu nhỏ khoảng cách -->
						</a> 
						<!-- Cart Section -->
						<a href="#" class="cart for-buy d-flex align-items-center">
							<i class="icon icon-clipboard"></i>
							<span class="ms-2">Cart: (0$)</span>
						</a>
       					 <!-- Search Section -->
						<div class="action-menu d-flex align-items-center">
							<div class="search-bar">
								<a href="#" class="search-button search-toggle" data-selector="#header-wrap">
									<i class="icon icon-search"></i>
								</a>
								<form role="search" method="get" class="search-box d-flex align-items-center">
                                    <input class="search-field form-control search-input shadow-lg" placeholder="Search" type="search">
                                </form>
							</div>
						</div>
    				</div><!--top-right-->
				</div>
            </div><!--row-->
        </div><!--container-fluid-->
    </div><!--top-content-->
</div><!--header-wrap-->
<header id="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="main-logo">
                    <a href="index.php?controller=auth&action=home"><img src="assets/images/main-logo.png" alt="logo"></a>
                </div>
            </div>

            <div class="col-md-10">
                <nav id="navbar">
                    <div class="main-menu stellarnav">
                        <ul class="menu-list">
                            <li class="menu-item active"><a href="#home">Home</a></li>
                            <li class="menu-item has-sub">
                                <a href="#pages" class="nav-link">Pages</a>
                                <ul>
                                    <li class="active"><a href="index.html">Home</a></li>
                                    <li><a href="index.html">About</a></li>
                                    <li><a href="index.html">Styles</a></li>
                                    <li><a href="index.html">Blog</a></li>
                                    <li><a href="index.html">Post Single</a></li>
                                    <li><a href="index.html">Our Store</a></li>
                                    <li><a href="index.html">Product Single</a></li>
                                    <li><a href="index.html">Contact</a></li>
                                    <li><a href="index.html">Thank You</a></li>
                                </ul>
                            </li>
							<li class="menu-item"><a href="#featured-books" class="nav-link">Featured</a></li>
									<li class="menu-item"><a href="#popular-books" class="nav-link">Popular</a></li>
									<li class="menu-item"><a href="#special-offer" class="nav-link">Offer</a></li>
									<li class="menu-item"><a href="#latest-blog" class="nav-link">Articles</a></li>
									<li class="menu-item"><a href="#download-app" class="nav-link">Download App</a></li>
                            <li class="menu-item">
                                <?php
                                    if ($userLoggedIn) {
                                        echo '<a href="index.php?controller=auth&action=logout">Đăng xuất</a>';
                                    } else {
                                        echo '<a href="index.php?controller=auth&action=login">Đăng nhập</a>';
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
</body>
</html>
