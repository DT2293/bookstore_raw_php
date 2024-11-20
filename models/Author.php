<?php
require_once 'config.php'; 

class Author {
    private $conn;
    public function __construct() {
        global $servername, $username, $password, $dbname; // Khai báo các biến toàn cục
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Kết nối thất bại: " . $e->getMessage();
        }
    }
     // Lấy tất cả tác giả từ cơ sở dữ liệu
     public function getAllAuthors()
     {
        $stmt = $this->conn->prepare("select * from authors");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
     }
    }   
?>
