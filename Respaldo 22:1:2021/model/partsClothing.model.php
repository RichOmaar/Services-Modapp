<?php

require_once 'connection.php';

class modelPartsClothing {

    public function mdlAddPartClothing($partName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO parts_clothing (name) VALUES (:partName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':partName', $partName);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdatePartClothing($idPartName, $partName) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE parts_clothing SET name = :partName WHERE id_partsClothing = :idPartName";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':partName', $partName);

        $statement -> bindParam(':idPartName', $idPartName);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeletePartClothing($idPartName) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM parts_clothing WHERE id_partsClothing = :idPartName";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idPartName', $idPartName);

        $statement -> execute();

        return ($statement);
    }

    //SELECT GENERAL
    public function mdlGeneralInfoPartClothing() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM parts_clothing";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false; 
        
    }

    public function mdlInfoPartClothing($idPartName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM parts_clothing WHERE id_partsClothing = :idPartName";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idPartName', $idPartName);
        
        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false; 
        
    }
}
?>