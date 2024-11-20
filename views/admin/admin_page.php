<?php
// views/admin/admin_page.php

//session_start();

// Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải Admin
if (!isset($_SESSION['user']) || $_SESSION['user']['Role'] !== 'Admin') {
    // Chuyển hướng về trang login nếu không có quyền truy cập
    header("Location: index.php?controller=auth&action=login");
    exit();
}

// Lấy thông tin người dùng đăng nhập
$user = $_SESSION['user'];
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
							<!-- <li class="menu-item"><a href="#featured-books" class="nav-link">Featured</a></li>
									<li class="menu-item"><a href="#popular-books" class="nav-link">Popular</a></li>
									<li class="menu-item"><a href="#special-offer" class="nav-link">Offer</a></li>
									<li class="menu-item"><a href="#latest-blog" class="nav-link">Articles</a></li>
									<li class="menu-item"><a href="#download-app" class="nav-link">Download App</a></li>
                            <li class="menu-item"> -->
                                <a href="index.php?controller=auth&action=logout">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
    <div class="container mt-2">
        <h1 class="mb-2">Admin Dashboard</h1>
        <div class="card">
            <div class="card-body">
                <h3 class="card-title"><strong>Thông tin tài khoản</strong></h3>
                <p><strong>Họ tên:</strong> <?php echo htmlspecialchars($user['FullName']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($user['Email']); ?></p>
                <p><strong>Vai trò:</strong> <?php echo htmlspecialchars($user['Role']); ?></p>
            </div>
            <div class="mt-1">
                 <a class="btn btn-accent-arrow mt-1 " href="views/admin/add_book.php">Thêm sách</a>
            </div>
        </div>
    </div>
  





</body>
</html>
