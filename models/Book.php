<?php
require_once 'config.php'; 

class Book
{
    // Thêm sách vào cơ sở dữ liệu
    public function addBook($title, $author_id, $category_id, $price, $quantity, $published_date, $description, $cover_image_url)
    {
        // Kết nối cơ sở dữ liệu
        $db = Database::getConnection();

        // Câu lệnh SQL để thêm sách vào bảng Books
        $query = "INSERT INTO Books (Title, AuthorID, CategoryID, Price, Quantity, PublishedDate, Description, CoverImageURL)
                  VALUES (:title, :author_id, :category_id, :price, :quantity, :published_date, :description, :cover_image_url)";
        
        // Chuẩn bị câu lệnh SQL
        $stmt = $db->prepare($query);

        // Gắn giá trị cho các tham số trong câu lệnh
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author_id', $author_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':published_date', $published_date);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':cover_image_url', $cover_image_url);

        // Thực thi câu lệnh SQL và trả về kết quả (true nếu thành công, false nếu có lỗi)
        return $stmt->execute();
    }
}
?>
