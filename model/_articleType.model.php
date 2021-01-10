<?php
 
require_once 'connection.php';

class modelArticletype {

    public function mdlAddArticleType($typeName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO article_type (typeName) VALUES (:typeName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':typeName', $typeName);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateArticleType($typeName, $idArticleType) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE article_type SET typeName = :typeName WHERE id_articleType = :idArticleType";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':typeName', $typeName);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteArticleType($idArticleType) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM article_type WHERE id_articleType = :idArticleType";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoArticleType() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM article_type";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
   
    }

    public function mdlInfoArticleType($idArticleType) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_articleType, typeName FROM article_type WHERE id_articleType = :idArticleType";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}
?>