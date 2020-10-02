<?php
 
require_once 'connection.php';

class modelLabelSeason {

    public function mdlAddLabelSeason($seasonName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO label_season (seasonName) VALUES (:seasonName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':seasonName', $seasonName);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateLabelSeason($seasonName, $idLabelSeason) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE label_season SET seasonName = :seasonName WHERE id_labelSeason = :idLabelSeason";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':seasonName', $seasonName);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteLabelSeason($idLabelSeason) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM label_season WHERE id_labelSeason = :idLabelSeason";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoLabelSeason() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM `label_season`";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
   
    }

    public function mdlInfoLabelSeason($idLabelSeason) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT `id_labelSeason`, `seasonName` FROM `label_season` WHERE id_labelSeason = :idLabelSeason";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>