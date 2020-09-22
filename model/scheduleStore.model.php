<?php

require_once 'connection.php';

class modelScheduleStore {

    //Horarios de atención del cliente
    public function mdlInfoSchedule($idStore) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT days.day, hour.id_store, hour.open, hour.close FROM store LEFT JOIN hour ON store.id_store = hour.id_store LEFT JOIN days ON hour.id_day = days.id_day WHERE store.id_store = :id_store";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_store', $idStore);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) :  false;

    }

    public function mdlCountScheduleAdded($idStore){

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT COUNT(*) FROM hour WHERE id_store = :id_store";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_store',$idStore);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) :  false;
    }

    public function mdlAddFirstSchedule($idStore, $openL, $closeL, $openM, $closeM, $openW, $closeW, $openJ, $closeJ, $openV, $closeV, $openS, $closeS, $openD, $closeD) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = ("INSERT INTO hour (id_day, id_store, open, close) VALUES (1, :id_store, :openL, :closeL),(2, :id_store, :openM, :closeM),(3, :id_store, :openW, :closeW),(4, :id_store, :openJ, :closeJ),(5, :id_store, :openV, :closeV),(6, :id_store, :openS, :closeS),(7, :id_store, :openD, :closeD)");

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_store',$idStore);

        $statement -> bindParam(':openL',$openL);

        $statement -> bindParam(':closeL',$closeL);

        $statement -> bindParam(':openM',$openM);

        $statement -> bindParam(':closeM',$closeM);

        $statement -> bindParam(':openW',$openW);

        $statement -> bindParam(':closeW',$closeW);

        $statement -> bindParam(':openJ',$openJ);

        $statement -> bindParam(':closeJ',$closeJ);

        $statement -> bindParam(':openV',$openV);

        $statement -> bindParam(':closeV',$closeV);

        $statement -> bindParam(':openS',$openS);

        $statement -> bindParam(':closeS',$closeS);

        $statement -> bindParam(':openD',$openD);

        $statement -> bindParam(':closeD',$closeD);

        
        return $statement->execute();
    }

    public function mdlAddMoreSchedule($idStore, $openL, $closeL, $openM, $closeM, $openW, $closeW, $openJ, $closeJ, $openV, $closeV, $openS, $closeS, $openD, $closeD) {

        $db = new Connection();

        $connection = $db -> get_connection();

        //$connection = $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $sql = ("UPDATE hour SET open = :openL, close = :closeL WHERE id_day = 1 AND id_store = :id_store;
        UPDATE hour SET open = :openM, close = :closeM WHERE id_day = 2 AND id_store = :id_store;
        UPDATE hour SET open = :openW, close = :closeW WHERE id_day = 3 AND id_store = :id_store;
        UPDATE hour SET open = :openJ, close = :closeJ WHERE id_day = 4 AND id_store = :id_store;
        UPDATE hour SET open = :openV, close = :closeV WHERE id_day = 5 AND id_store = :id_store;
        UPDATE hour SET open = :openS, close = :closeS WHERE id_day = 6 AND id_store = :id_store;
        UPDATE hour SET open = :openD, close = :closeD WHERE id_day = 7 AND id_store = :id_store;");

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_store',$idStore);

        $statement -> bindParam(':openL',$openL);

        $statement -> bindParam(':closeL',$closeL);

        $statement -> bindParam(':openM',$openM);

        $statement -> bindParam(':closeM',$closeM);

        $statement -> bindParam(':openW',$openW);

        $statement -> bindParam(':closeW',$closeW);

        $statement -> bindParam(':openJ',$openJ);

        $statement -> bindParam(':closeJ',$closeJ);

        $statement -> bindParam(':openV',$openV);

        $statement -> bindParam(':closeV',$closeV);

        $statement -> bindParam(':openS',$openS);

        $statement -> bindParam(':closeS',$closeS);

        $statement -> bindParam(':openD',$openD);

        $statement -> bindParam(':closeD',$closeD);

        $statement -> execute();

        return $statement;
    }
    //
}

?>