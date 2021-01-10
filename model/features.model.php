<?php

require_once 'connection.php';

class modelFeatures {

    public function mdlAddFeature($featureName,$value,$idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO features (featureName, value, id_product) VALUES (:featureName, :value, :idProduct)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':featureName', $featureName);
        
        $statement -> bindParam(':value', $value);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlUpdateFeature($featureName, $value, $idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE features SET featureName = :featureName, value = :value WHERE id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':featureName', $featureName);
        
        $statement -> bindParam(':value', $value);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    
    }

    public function mdlDeleteFeature($idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();
        
        $sql = "DELETE FROM features WHERE id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
   
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

        $sql = "SELECT id_feature, featureName, value FROM features WHERE id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlLastFeatureId() {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM features ORDER BY id_feature DESC";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

}

?>