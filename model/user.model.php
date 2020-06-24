<?php
require_once 'connection.php';

class modelUser {
    
    public function mdlAddAddress($idUser,$state,$municipio,$street,$number_st,$number_int,$cp) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO `address`(`state`, `municipio`, `street`, `number_st`, `number_int`, `cp`) VALUES (:state, :municipio, :street, :number_st,:number_int, :cp)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state',$state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$number_st);

        $statement -> bindParam(':number_int',$number_int);

        $statement -> bindParam(':cp',$cp);

        $statement -> execute();

        $last_id = $connection -> lastInsertId();

        if($statement -> rowCount() > 0){

            //$last_id = $connection -> lastInsertId();

            $sql = "UPDATE `user` SET `id_address`= :idAddress WHERE id_user = :idUser";

            $statement = $connection -> prepare($sql);

            $statement -> bindParam('idAddress',$last_id);

            $statement -> bindParam('idUser',$idUser);

            $statement -> execute();

            return ($statement -> rowCount() > 0) ? true : false;

        } else {

            return false;
        }

    }

    public function mdlDeleteAddress($idAddress) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM address WHERE id_address = :idAddres";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idAddres',$idAddress);

        $statement -> execute();

        return ($statement -> rowCount() > 0) ? true : false;

    }

    public function mdlInfoAddress($idUser) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM `user` WHERE id_user = :idUser";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser',$idUser);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false; 

    }

    public function mdlUpdateAddress($idUser,$idAddress,$state,$municipio,$street,$number_st,$number_int,$cp) {

        $db =  new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE address SET state = :state, municipio = :municipio, street = :street, number_st = :number_st, number_int = :number_int, cp = :cp WHERE id_address = (SELECT * FROM (SELECT user.id_address FROM user LEFT JOIN address ON user.id_address = address.id_address WHERE user.id_user = :idUser)example)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state',$state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$number_st);

        $statement -> bindParam(':number_int',$number_int);

        $statement -> bindParam(':cp',$cp);

    }
}


/*

DELETE FROM `address` WHERE id_address = (SELECT user.id_address FROM user LEFT JOIN address ON user.id_address = address.id_address WHERE user.id_user = 1)

*/

?>

