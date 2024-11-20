<?php
require_once 'config.php'; 

class Book
{private $conn;

    public function __construct() {
        global $servername, $username, $password, $dbname; // Khai báo các biến toàn cục
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
        }
    }
    // Thêm sách vào cơ sở dữ liệu
    public function addBook($title, $author_id, $category_id, $price, $quantity, $published_date, $description, $cover_image_url)
    {
        try {
            // Chuẩn bị câu lệnh SQL để thêm sách
            $sql = "INSERT INTO books (title, author_id, category_id, price, quantity, published_date, description, cover_image_url)
                    VALUES (:title, :author_id, :category_id, :price, :quantity, :published_date, :description, :cover_image_url)";
    
            // Chuẩn bị truy vấn với tham số
            $stmt = $this->conn->prepare($sql);
    
            // Liên kết các tham số vào truy vấn
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':author_id', $author_id, PDO::PARAM_INT);
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':published_date', $published_date);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':cover_image_url', $cover_image_url);
    
            // Thực thi truy vấn
            $stmt->execute();
    
            echo "Sách đã được thêm thành công.";
        } catch (PDOException $e) {
            // Xử lý lỗi
            echo "Lỗi khi thêm sách: " . $e->getMessage();
        }

    }
}
?>
