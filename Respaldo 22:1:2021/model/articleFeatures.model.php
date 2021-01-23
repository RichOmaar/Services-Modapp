<?php
 
require_once 'connection.php';

class modelArticleFeatures {

    public function mdlAddArticleFeature($idArticleType, $idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO article_features(id_articleType, id_feature) VALUES (:idArticleType, :idFeature)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteArticleFeature($idArticleType, $idFeature) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM article_features WHERE id_articleType = :idArticleType AND id_feature = :idFeature";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> bindParam(':idFeature', $idFeature);

        $statement -> execute();

        return ($statement);
    }
}

?>