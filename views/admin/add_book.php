<?php
//Database connection
$host = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";
 

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: Please try again later.");
}

// Fetch authors and categories for the dropdowns
$authors = [];
$categories = [];

$authorResult = $conn->query("SELECT AuthorID, Name FROM Authors");
if ($authorResult->num_rows > 0) {
    while ($row = $authorResult->fetch_assoc()) {
        $authors[] = $row;
    }
}

$categoryResult = $conn->query("SELECT CategoryID, CategoryName FROM Categories");
if ($categoryResult->num_rows > 0) {
    while ($row = $categoryResult->fetch_assoc()) {
        $categories[] = $row;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST['title'];
    $author_id = $_POST['author_id'];
    $category_id = $_POST['category_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $published_date = $_POST['published_date'];
    $description = $_POST['description'];

//     $cover_image_url = null;
//     if (!empty($_FILES['cover_image']['name'])) {
//         $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/teststore/assets/uploads/";
//         $cover_image_url = $target_dir . basename($_FILES["cover_image"]["name"]);
//         if (!move_uploaded_file($_FILES["cover_image"]["tmp_name"], $cover_image_url)) {
//             echo "<p>Failed to upload cover image to $cover_image_url. Please check your server permissions.</p>";
//             exit;
//         }
        
//     }

//     $stmt = $conn->prepare("INSERT INTO Books (Title, AuthorID, CategoryID, Price, Quantity, PublishedDate, Description, CoverImageUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
//     $stmt->bind_param("siiidsss", $title, $author_id, $category_id, $price, $quantity, $published_date, $description, $cover_image_url);

//     // Execute and check for success
//     if ($stmt->execute()) {
//         echo "<p>Thêm sách mới thành công!</p>";
//     } else {
//         echo "<p>Đã xảy ra lỗi khi thêm sách: " . $stmt->error . "</p>";
//     }

//     // Close statement and connection
//     $stmt->close();
// }
$cover_image_url = null;
if (!empty($_FILES['cover_image']['name'])) {
    // Đường dẫn đến thư mục chứa ảnh
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/teststore/assets/uploads/";
    
    // Lấy tên file ảnh
    $cover_image_name = basename($_FILES["cover_image"]["name"]);
    
    // Đường dẫn đầy đủ của ảnh để lưu trữ
    $cover_image_url = "assets/uploads/" . $cover_image_name;
    
    // Di chuyển ảnh từ thư mục tạm vào thư mục uploads
    if (!move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_dir . $cover_image_name)) {
        echo "<p>Failed to upload cover image to $cover_image_url. Please check your server permissions.</p>";
        exit;
    }
}

// Insert dữ liệu vào cơ sở dữ liệu
$stmt = $conn->prepare("INSERT INTO Books (Title, AuthorID, CategoryID, Price, Quantity, PublishedDate, Description, CoverImageUrl) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiidsss", $title, $author_id, $category_id, $price, $quantity, $published_date, $description, $cover_image_url);

// Execute and check for success
if ($stmt->execute()) {
    echo "<p>Thêm sách mới thành công!</p>";
} else {
    echo "<p>Đã xảy ra lỗi khi thêm sách: " . $stmt->error . "</p>";
}
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sách Mới</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Thêm Sách Mới</h2>
        <form action="add_book.php" method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề sách</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề sách" required>
            </div>
            <div class="mb-3">
                <label for="author_id" class="form-label">Tác giả</label>
                <select class="form-select" id="author_id" name="author_id" required>
                    <option selected disabled>Chọn tác giả</option>
                    <?php foreach ($authors as $author): ?>
                        <option value="<?= $author['AuthorID'] ?>"><?= $author['Name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Thể loại</label>
                <select class="form-select" id="category_id" name="category_id" required>
                    <option selected disabled>Chọn thể loại</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['CategoryID'] ?>"><?= $category['CategoryName'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Nhập giá" required>
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Số lượng</label>
                <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Nhập số lượng" required>
            </div>
            <div class="mb-3">
                <label for="published_date" class="form-label">Ngày xuất bản</label>
                <input type="date" class="form-control" id="published_date" name="published_date" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Nhập mô tả về sách"></textarea>
            </div>
            <div class="mb-3">
                <label for="cover_image" class="form-label">Ảnh bìa</label>
                <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
            </div>
            <div class="d-flex justify-content-between">
            <a href="javascript:history.back()" class="btn btn-secondary">Quay lại</a>
                <button type="submit" class="btn btn-primary">Thêm Sách</button>
            </div>
           
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


