<?php
require_once 'config.php'; 

class Author {
     // Lấy tất cả tác giả từ cơ sở dữ liệu
     public function getAllAuthors()
     {
         $db = Database::getConnection();
         $query = "SELECT * FROM Authors";
         $stmt = $db->prepare($query);
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
     }
?>
