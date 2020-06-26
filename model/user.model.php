<?php

require_once 'connection.php';

class modelUser {

    public function mdlInfoUser($idUser){

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM user WHERE user.id_user = :idUser";
    
        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser',$idUser);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }
}

?>