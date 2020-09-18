<?php

require_once 'connection.php';

class modelGender {
   
    public function mdlAddGender($genderName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO gender (genderName) VALUES (:genderName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':genderName', $genderName);

        $statement -> execute();

        return ($statement);
    }
    
    public function mdlUpdateGender($genderName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE gender SET genderName = :genderName";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':genderName', $genderName);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteGender($idGenderName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM gender WHERE id_gender = :idGenderName";

        $statement = $connection -> prepare($sql);
        
        $statement -> bindParam(':idGenderName', $idGenderName);

        $statement -> execute();

        return ($statement);
    }

    //SELECT ESPECIFICO
    public function mdlInfoGender($idGenderName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_gender, genderName FROM gender WHERE id_gender = :idGenderName";

        $statement = $connection -> prepare($sql);
        
        $statement -> bindParam(':idGenderName', $idGenderName);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    //SELECT GENERAL
    public function mdlGeneralInfoGender() {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM gender";

        $statement = $connection -> prepare($sql);
        
        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }
}
?>