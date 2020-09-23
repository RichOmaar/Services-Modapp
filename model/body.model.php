<?php

require_once 'connection.php';

class modelBody {

    public function mdlAddBody($name) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO body (name) VALUES (:name)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':name', $name);

        $statement -> execute();

        return ($statement);

    }

    public function mdlUpdateBody($name,$idBody) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE body SET name = :name WHERE id_body = :idBody";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':name', $name);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteBody($idBody) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM body WHERE id_body = :idBody";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> execute();

        return ($statement);
    }

    //SELECT ESPECIFICO
    public function mdlInfoBody($idBody) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_body, name FROM body WHERE id_body = :idBody";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
    }

    //SELECT GENERAL
    public function mdlGeneralInfoBody() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM body";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}
?>