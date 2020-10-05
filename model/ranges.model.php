<?php

require_once 'connection.php';

class modelRanges {

    public function mdlAddRange($value) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO ranges (value) VALUES (:value)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':value', $value);

        $statement -> execute();

        return $statement;

    }

    public function mdlUpdateRange($idRange,$value) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE ranges SET value = :value WHERE id_range = :idRange";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(":value", $value);

        $statement -> bindParam(":idRange", $idRange);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteRange($idRange) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM ranges WHERE id_range = :idRange";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idRange', $idRange);

        $statement -> execute();

        return ($statement);
    }
    
    //SELECT GENERAL
    public function mdlGeneralInfoRange() {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM ranges";

        $statement = $connection -> prepare($sql);
        
        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlInfoRange($idRange) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM ranges WHERE id_range = :idRange";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idRange', $idRange);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

}

?>