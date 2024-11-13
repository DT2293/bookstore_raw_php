<?php
require_once 'models/Book.php';
require_once 'models/Author.php'; // Thêm model Author
require_once 'models/Category.php'; // Thêm model Category

// controllers/AdminController.php
// controllers/AdminController.php

class AdminController
{
    public function addBook()
{
    // Lấy danh sách tác giả và thể loại từ cơ sở dữ liệu
    $authorModel = new Author();
    $authors = $authorModel->getAllAuthors(); // Sử dụng hàm getAllAuthors

    $categoryModel = new Category();
    $categories = $categoryModel->getAllCategories(); // Sử dụng hàm getAllCategories

    // Xử lý form khi được gửi
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Lấy dữ liệu từ form
        $title = $_POST['title'];
        $author_id = $_POST['author_id'];
        $category_id = $_POST['category_id'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $published_date = $_POST['published_date'];
        $description = $_POST['description'];

        // Xử lý ảnh bìa
        if (isset($_FILES['cover_image']) && $_FILES['cover_image']['error'] == 0) {
            $cover_image_url = 'assets/uploads/' . $_FILES['cover_image']['name'];
            move_uploaded_file($_FILES['cover_image']['tmp_name'], $cover_image_url);
        } else {
            $cover_image_url = null;
        }

        // Gọi phương thức addBook từ model Book để thêm sách
        $bookModel = new Book();
        $isAdded = $bookModel->addBook($title, $author_id, $category_id, $price, $quantity, $published_date, $description, $cover_image_url);

        if ($isAdded) {
            // Thành công, chuyển hướng đến trang danh sách sách
            header("Location: index.php?controller=book&action=index");
            exit();
        } else {
            // Nếu có lỗi khi thêm sách
            $errorMessage = "Có lỗi xảy ra khi thêm sách!";
        }
    }

    // Gọi view và truyền dữ liệu
    include 'views/admin/add_book.php';  // Truyền danh sách tác giả và thể loại vào view
}

    
}
?>



