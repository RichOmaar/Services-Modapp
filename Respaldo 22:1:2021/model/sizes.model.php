<?php

require_once 'connection.php';

class modelSizes {

    public function mdlAddSize($size) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO sizes (size) VALUES (:size)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':size', $size);

        $statement -> execute();

        return ($statement);
    
    }

    public function mdlUpdateSize($idSize,$size) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE sizes SET size = :size WHERE id_size = :idSize";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':size', $size);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteSize($idSize) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM sizes WHERE id_size = :idSize";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> execute();

        return ($statement);

    }

    //SELECT GENERAL
    public function mdlGeneralInfoSize() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM sizes";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlInfoSize($idSize) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM sizes WHERE id_size = :idSize";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>