
<?php

require_once 'connection.php';

class modelAddress {
    
    public function mdlAddAddressUser($idUser,$state,$municipio,$street,$number_st,$number_int,$cp) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO `address`(`state`, `municipio`, `street`, `number_st`, `number_int`, `cp`, id_user) VALUES (:state, :municipio, :street, :number_st,:number_int, :cp, :idUser)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state',$state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$number_st);

        $statement -> bindParam(':number_int',$number_int);

        $statement -> bindParam(':cp',$cp);

        $statement -> bindParam(':idUser', $idUser);

        $statement -> execute();

        return ($statement->rowCount() > 0? true: false);

    }

    public function mdlAddAddressClient($idClient,$state,$municipio,$street,$number_st,$number_int,$cp) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO `address`(`state`, `municipio`, `street`, `number_st`, `number_int`, `cp`, id_client) VALUES (:state, :municipio, :street, :number_st,:number_int, :cp, :idClient)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state',$state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$number_st);

        $statement -> bindParam(':number_int',$number_int);

        $statement -> bindParam(':cp',$cp);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0? true: false);

    }

    public function mdlAddAddressStore($idStore,$state,$municipio,$street,$number_st,$number_int,$cp) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO `address`(`state`, `municipio`, `street`, `number_st`, `number_int`, `cp`, store) VALUES (:state, :municipio, :street, :number_st,:number_int, :cp, :store)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state',$state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$number_st);

        $statement -> bindParam(':number_int',$number_int);

        $statement -> bindParam(':cp',$cp);

        $statement -> bindParam(':store', $idStore);

        $statement -> execute();

        return ($statement->rowCount() > 0? true: false);

    }

    public function mdlDeleteAddress($idAddress) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM address WHERE id_address = :idAddress";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idAddress',$idAddress);

        $statement -> execute();

        return ($statement->rowCount() > 0? true: false);

    }

    public function mdlInfoAddressUser($idUser) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_address, state, municipio, street, number_st, number_int, cp, status, id_address FROM address WHERE id_user = :idUser";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser',$idUser);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false; 

    }

    public function mdlInfoAddressClient($idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_address, state, municipio, street, number_st, number_int, cp, status, id_client FROM address WHERE id_client = :idClient";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idClient',$idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false; 

    }

    public function mdlInfoAddressStore($idStore) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_address, state, municipio, street, number_st, number_int, cp, status, store FROM address WHERE store = :idStore";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idStore',$idStore);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false; 

    }

    public function mdlUpdateAddress($idAddress,$state,$municipio,$street,$number_st,$number_int,$cp) {

        $db =  new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE address SET state = :state, municipio = :municipio, street = :street, number_st = :number_st, number_int = :number_int, cp = :cp WHERE id_address = :id_address";

        //$sql = "UPDATE address SET state = :state, municipio = :municipio, street = :street, number_st = :number_st, number_int = :number_int, cp = :cp WHERE id_address = :idAddress";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':state', $state);
        
        $statement -> bindParam(':municipio',$municipio);

        $statement -> bindParam(':street',$street);

        $statement -> bindParam(':number_st',$number_st);

        $statement -> bindParam(':number_int',$number_int);

        $statement -> bindParam(':cp',$cp);

        $statement -> bindParam(':id_address',$idAddress);

        $statement -> execute();

        return $statement->rowCount() > 0? true: false;
    }
}

/*

DELETE FROM `address` WHERE id_address = (SELECT user.id_address FROM user LEFT JOIN address ON user.id_address = address.id_address WHERE user.id_user = 1)

*/

?>

