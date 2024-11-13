<?php
require_once 'config.php'; // Bao gồm file config.php

class Customer {
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

    // Hàm kiểm tra đăng nhập
    public function login($email, $password) {
        $query = "SELECT * FROM Customers WHERE Email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // So sánh mật khẩu trực tiếp (không mã hóa)
        if ($user && $password == $user['Password']) {
            return $user;  // Đăng nhập thành công
        }
    
        return false; // Đăng nhập thất bại
    }
    
}
?>
