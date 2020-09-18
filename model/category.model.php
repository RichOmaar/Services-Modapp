<?php

require_once 'connection.php';

class modelCategory {

    public function mdlAddCategory($categoryName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO category (categoryName) VALUES (:categoryName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':categoryName', $categoryName);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateCategory($categoryName, $idCategory) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE category SET categoryName = :categoryName WHERE id_category = :idCategory";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':categoryName', $categoryName);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteCategory($idCategory) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM category WHERE id_category = :idCategory";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> execute();

        return ($statement);
    }

    public function mdlInfoCategory() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM category";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlGeneralInfoCategory($idCategory) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_category, categoryName FROM category WHERE id_category = :idCategory";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}
?>