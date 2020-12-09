<?php

require_once 'connection.php';

class modelMeasurement {

    public function mdlAddMeasurement($idRange, $idPartClothing, $idSize) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO measurements (id_range, id_partsClothing, id_size) VALUES (:id_range, :id_partsClothing, :id_size)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_range', $idRange);

        $statement -> bindParam(':id_partsClothing', $idPartClothing);

        $statement -> bindParam(':id_size', $idSize);

        $statement -> execute();

        if(!$statement) {

            return ($statement);
            

        } else {

            $lastId = new modelMeasurement();

            $data = $lastId -> mdlGeneralInfoMeasurement();
        //echo json_encode($data[0]['id_measurement']);
            return ($data[0]['id_measurement']);

        }

        //        $last_id = $db -> insert_id;

    }

    public function mdlUpdateMeasurement($idRange, $idPartClothing, $idSize, $idMeasurement) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE measurements SET id_range = :id_range, id_partsClothing = :id_partsClothing, id_size = :id_size WHERE id_measurement = :id_measurement";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_range', $idRange);

        $statement -> bindParam(':id_partsClothing', $idPartClothing);

        $statement -> bindParam(':id_size', $idSize);

        $statement -> bindParam(':id_measurement', $idMeasurement);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
            
    }

    public function mdlDeleteMeasurement($idMeasurement) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM measurements WHERE id_measurement = :id_measurement";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_measurement', $idMeasurement);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
        
    }

    public function mdlGetIdMeasurement($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_measurement FROM products WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }
    
    //SELECT GENERAL
    public function mdlInfoMeasurement($idMeasurement) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_measurement, id_range, id_partsClothing, id_size FROM measurements WHERE id_measurement = :id_measurement";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_measurement', $idMeasurement);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
        
    }

    public function mdlGeneralInfoMeasurement() {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM measurements ORDER BY id_measurement DESC";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>