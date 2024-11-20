<?php
require_once 'config.php'; 

class Category {
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
    public function getAllCategories()
    {
        //get all categories from the database
        $stmt = $this->conn->prepare("select * from categories");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>
