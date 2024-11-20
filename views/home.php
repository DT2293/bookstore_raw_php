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

// Database connection (MySQLi)
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books from the database
$sql = "SELECT BookID, title, description, CoverImageURL FROM Books LIMIT 2 OFFSET 1"; // Giới hạn 2 sách để hiển thị
$result = $conn->query($sql);
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Kiểm tra xem form có được gửi chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    $book_price = $_POST['book_price'];
    $quantity = 1; // Mặc định là thêm 1 sản phẩm vào giỏ hàng

    // Hàm thêm sản phẩm vào giỏ hàng
    function add_to_cart($book_id, $book_title, $book_author, $book_price, $quantity) {
        $found = false;
        
        // Kiểm tra nếu sản p   hẩm đã có trong giỏ hàng
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['book_id'] == $book_id) {
                $item['quantity'] += $quantity; // Nếu đã có, tăng số lượng
                $found = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
        if (!$found) {
            $_SESSION['cart'][] = [
                'book_id' => $book_id,
                'book_title' => $book_title,
                'book_author' => $book_author,
                'book_price' => $book_price,
                'quantity' => $quantity
            ];
        }
    }

    // Thêm sản phẩm vào giỏ hàng
    add_to_cart($book_id, $book_title, $book_author, $book_price, $quantity);

    // Chuyển hướng lại trang sản phẩm hoặc trang giỏ hàng sau khi thêm
    header('Location: ../view_cart.php'); // Bạn có thể thay đổi địa chỉ URL theo nhu cầu
    exit();
}

// Kiểm tra session sau khi thêm sản phẩm vào giỏ
print_r($_SESSION['cart']);

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
<div id="header-wrap" >
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


                        <!-- <a href="views/view_cart.php" class="cart for-buy">
                            <i class="icon icon-clipboard"></i>
                            <span class="ms-2">Cart: (<?php echo $totalPrice; ?>$)</span>
                        </a> -->

                       <!-- <a class="btn btn-accent-arrow mt-1 " href="views/admin/add_book.php">Thêm sách</a> -->
                        <form  action="views/view_cart.php" class="mb-1" method="POST">
                            <button type="submit" class="cart for-buy d-flex align-items-center">
                                 <i class="icon icon-clipboard"></i>
                            <span class="ms-2">Cart: (0$)</span>
                            </button>
                        </form> 
                         
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
<header id="header" class="pt-1">
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

<section id="billboard" >
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Nút điều hướng trái -->
                <button class="prev slick-arrow">
                    <i class="icon icon-arrow-left"></i>
                </button>
                <!-- Main slider container, thêm lớp slick-slider -->
                <div class="main-slider slick-slider pattern-overlay">
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class="slider-item">
                            <div class="banner-content">
                                <h2 class="banner-title"><?php echo htmlspecialchars($row['title']); ?></h2>
                                <p><?php echo htmlspecialchars($row['description']); ?></p>
                                <div class="btn-wrap">
                                    <a href="#" class="btn btn-outline-accent btn-accent-arrow">
                                        Read More<i class="icon icon-ns-arrow-right"></i>
                                    </a>
                                </div>
                            </div><!-- banner-content -->
                            <!-- Hiển thị hình ảnh với đường dẫn chính xác -->
                            <img src="/teststore/assets/uploads/<?php echo basename($row['CoverImageURL']); ?>" alt="banner" class="banner-image">
                        </div><!-- slider-item -->
                    <?php } ?>
                </div><!-- main-slider -->

                <!-- Nút điều hướng phải -->
                <button class="next slick-arrow">
                    <i class="icon icon-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<section id="featured-books" class="featured-books-section">
    <div class="container">
        <div class="section-header">
            <div class="title">
                <span>Some quality items</span>
            </div>
            <h2 class="section-title">Fiction Books</h2>
        </div>

        <div class="product-list">
            <div class="row">
                <?php 
                require_once 'views/home.php'; 
                // Truy vấn các sách có CategoryID = 1 với JOIN giữa Books và Author
                $book_category_1 = "SELECT b.BookID, b.title, b.Quantity, a.Name as author, b.price, b.CoverImageURL 
                                    FROM Books b
                                    JOIN authors a ON b.AuthorID = a.AuthorID
                                    WHERE b.CategoryID = 1
                                    LIMIT 4 OFFSET 1"; 

                $rs_category_1 = $conn->query($book_category_1);

                // Kiểm tra xem có kết quả không
                if ($rs_category_1->num_rows > 0) {
                    while ($row = $rs_category_1->fetch_assoc()) {
                ?>
                    <div class="col-md-3 mb-4">
                        <div class="product-item card h-100 text-center">
                            <figure class="product-style card-img-top d-flex align-items-center justify-content-center mt-3 mb-1">
                                <!-- Hiển thị ảnh bìa sách -->
                                <img src="/teststore/assets/uploads/<?php echo basename($row['CoverImageURL']); ?>" alt="Books" class="product-image img-fluid">

                                <!-- Form Add to Cart -->
                                <form method="post" action="home.php" class="book-form">
                                    <input type="hidden" name="book_id" value="<?= htmlspecialchars($row['BookID']); ?>"> 
                                    <input type="hidden" name="book_title" value="<?= htmlspecialchars($row['title']); ?>"> 
                                    <input type="hidden" name="book_author" value="<?= htmlspecialchars($row['author']); ?>"> 
                                    <input type="hidden" name="book_price" value="<?= htmlspecialchars($row['price']); ?>"> 

                                    <button type="submit" 
                                            class="btn btn-primary add-to-cart mt-2" 
                                            data-book-id="<?= htmlspecialchars($row['BookID']); ?>" 
                                            data-book-title="<?= htmlspecialchars($row['title']); ?>" 
                                            data-book-quantity="<?= htmlspecialchars($row['Quantity']); ?>" 
                                            data-book-price="<?= number_format($row['price'], 2, '.', ''); ?>"> 
                                        Add <?= htmlspecialchars($row['title']); ?> to Cart
                                    </button>
                                </form>

                            </figure>
                        
                            <figcaption class="card-body text-center">
                                <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                               <strong><span class="card-subtitle text-muted"><?php echo htmlspecialchars($row['author']); ?></span></strong>
                                <br>
                                <strong><span class="card-subtitle text-muted">Stock: <?php echo htmlspecialchars($row['Quantity']); ?></span></strong>
                                <div class="item-price text-primary mt-2">$<?php echo htmlspecialchars($row['price']); ?></div>
                            </figcaption>
                        </div><!-- product-item -->
                    </div><!-- col-md-3 -->
                <?php } } ?>
                 <script>
                                // Lắng nghe sự kiện click trên các nút
                    document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault(); // Ngăn gửi form để kiểm tra
                            console.log("Book ID:", this.dataset.bookId);
                                console.log("Book Title:", this.dataset.bookTitle);
                            });
                    });
                    let TotalOfClickBook = 0;
                    let totalPrice = 0.0;
                    const cartDisplay = document.querySelector('.cart .ms-2');

                    // Thêm sự kiện click cho các nút Add to Cart
                    document.querySelectorAll('.add-to-cart').forEach(button => {
                        button.addEventListener('click', function (event) {
                            event.preventDefault(); // Ngăn form gửi đi để kiểm tra

                            // Lấy giá sách từ data attribute
                            const bookPrice = parseFloat(this.dataset.bookPrice);

                            // Debug kiểm tra giá trị
                            console.log("Raw Book Price:", this.dataset.bookPrice); // Giá trị gốc
                            console.log("Parsed Book Price:", bookPrice); // Sau khi parseFloat

                            if (isNaN(bookPrice)) {
                                console.error("Book price is invalid. Check data-book-price.");
                                return;
                            }

                            // Cộng giá sách vào tổng giá
                            totalPrice += bookPrice;

                            // Cập nhật nội dung giỏ hàng
                            cartDisplay.textContent = `Cart: (${totalPrice.toFixed(2)}$)`;
                        });
                    });
                    function logout() {
                        localStorage.removeItem('cart');
                        // Xử lý đăng xuất khác
                        console.log("User logged out. Cart cleared.");
                    }
                </script>  

          
            </div><!-- row -->
        </div><!-- product-list -->
    </div><!-- container -->
</section><!-- featured-books --> 
<?php
$conn->close();
?>

<!-- Đảm bảo rằng bạn không sử dụng ~ trong đường dẫn -->
<script src="assets/js/jquery-1.11.0.min.js"></script>  <!-- Đường dẫn đúng tới jQuery -->
<script src="assets/js/script.js"></script>  <!-- Đường dẫn đúng tới script.js -->
<script src="assets/js/modernizr.js"></script>  <!-- Đường dẫn đúng tới modernizr.js -->
<script src="assets/js/plugins.js"></script>  <!-- Đường dẫn đúng tới plugins.js -->
<script src="assets/js/slideNav.js"></script>  <!-- Đường dẫn đúng tới slideNav.js -->
<script src="assets/js/slideNav.min.js"></script>  <!-- Đường dẫn đúng tới slideNav.min.js -->

</body>
</html>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Khởi tạo Slick Slider
        $('.main-slider').slick({
            dots: true,                  // Hiển thị các dấu chấm điều hướng
            infinite: true,              // Lặp lại slider
            speed: 500,                  // Tốc độ di chuyển của slider
            slidesToShow: 1,             // Hiển thị 1 slide mỗi lần
            slidesToScroll: 1,           // Cuộn 1 slide mỗi lần
            prevArrow: $('.prev'),       // Nút quay lại
            nextArrow: $('.next'),       // Nút tiếp theo
        });
    });
</script>

<!-- <form method="post" class="book-form">
                                    <input type="hidden" name="book_id" value="<?= $row['BookID']; ?>"> 
                                    <input type="hidden" name="book_title" value="<?= htmlspecialchars($row['title']); ?>"> 
                                    <button type="submit" 
                                            class="btn btn-primary add-to-cart mt-2" 
                                            data-book-id="<?= $row['BookID']; ?>" 
                                            data-book-title="<?= htmlspecialchars($row['title']); ?>" 
                                            data-book-quantity="<?= htmlspecialchars($row['Quantity']); ?>" 
                                            data-book-price="<?= number_format($row['price'], 2, '.', ''); ?>"> 
                                        Add <?= htmlspecialchars($row['title']); ?> to Cart
                                    </button>

                                </form> -->

<!-- 
                                
                                <script>
    document.addEventListener("DOMContentLoaded", () => {
        // Lấy hiển thị giỏ hàng
        const cartDisplay = document.querySelector('.cart .ms-2');
        let cart = JSON.parse(localStorage.getItem('cart')) || { items: [], totalPrice: 0 };

        // Hiển thị lại giỏ hàng từ localStorage
        updateCartDisplay();

        // Lắng nghe sự kiện click trên các nút Add to Cart
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Ngăn form gửi đi để kiểm tra

                // Lấy thông tin sách
                const bookId = this.dataset.bookId;
                const bookTitle = this.dataset.bookTitle;
                const bookPrice = parseFloat(this.dataset.bookPrice);

                // Debug kiểm tra giá trị
                console.log("Book ID:", bookId);
                console.log("Book Title:", bookTitle);
                console.log("Parsed Book Price:", bookPrice);

                if (isNaN(bookPrice)) {
                    console.error("Book price is invalid. Check data-book-price.");
                    return;
                }

                // Thêm sách vào giỏ hàng
                const existingItem = cart.items.find(item => item.id === bookId);
                if (existingItem) {
                    existingItem.quantity += 1;
                } else {
                    cart.items.push({
                        id: bookId,
                        title: bookTitle,
                        price: bookPrice,
                        quantity: 1
                    });
                }

                // Cộng giá sách vào tổng giá
                cart.totalPrice += bookPrice;

                // Lưu giỏ hàng vào localStorage
                localStorage.setItem('cart', JSON.stringify(cart));

                // Cập nhật nội dung hiển thị giỏ hàng
                updateCartDisplay();
            });
        });

        // Lắng nghe sự kiện thay đổi trên localStorage (đa tab)
        window.addEventListener('storage', () => {
            cart = JSON.parse(localStorage.getItem('cart')) || { items: [], totalPrice: 0 };
            updateCartDisplay();
        });

        // Hàm cập nhật nội dung hiển thị giỏ hàng
        function updateCartDisplay() {
            cartDisplay.textContent = `Cart: (${cart.totalPrice.toFixed(2)}$)`;
        }
    });

    function logout() {
        // Xóa giỏ hàng khỏi localStorage
        localStorage.removeItem('cart');

        // Cập nhật giỏ hàng về 0 ngay lập tức
        const cartDisplay = document.querySelector('.cart .ms-2');
        cartDisplay.textContent = "Cart: (0.00$)";

        // Xử lý đăng xuất khác
        console.log("User logged out. Cart cleared.");
    }
</script> -->
