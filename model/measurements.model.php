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

        return ($statement);
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

        return ($statement);
    }

    public function mdlDeleteMeasurement($idMeasurement) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM measurements WHERE id_measurement = :id_measurement";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_measurement', $idMeasurement);

        $statement -> execute();

        return ($statement);
        
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
}

?>