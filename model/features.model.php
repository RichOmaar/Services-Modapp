<?php

require_once 'connection.php';

class modelFeatures {

    public function mdlAddFeature($featureName,$value) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO features (featureName, value) VALUES (:featureName, :value)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':featureName', $featureName);
        
        $statement -> bindParam(':value', $value);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateFeature($featureName, $idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE features SET featureName = :featureName WHERE id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':featureName', $featureName);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteFeature($idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();
        
        $sql = "DELETE FROM features WHERE id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoFeature() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM features";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    
    }

    public function mdlInfoFeature($idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_feature, featureName FROM features WHERE id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}
?>