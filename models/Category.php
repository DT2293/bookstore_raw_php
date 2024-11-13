<?php
require_once 'config.php'; 

class Category {
    public function getAllCategories()
    {
        $db = Database::getConnection();
        $query = "SELECT * FROM Categories";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
