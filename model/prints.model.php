<?php

require_once 'connection.php';

class modelPrints {

    public function mdlAddPrint($printName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO prints(printName) VALUES (:printName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':printName', $printName);

        $statement -> execute();

        return ($statement);

    }

    public function mdlUpdatePrint($printName,$idPrint) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE prints SET printName = :printName WHERE id_print = :idPrint";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':printName', $printName);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDelePrint($idPrint) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM prints WHERE id_print = :idPrint";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoPrint() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM prints";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlInfoPrint($idPrint) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_print, printName FROM prints WHERE id_print = :idPrint";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>