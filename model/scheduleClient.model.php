<?php

require_once 'connection.php';

class modelScheduleClient {

    //Horarios de atención del cliente
    public function mdlInfoSchedule($idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT days.day, hour.id_client, hour.open, hour.close FROM client LEFT JOIN hour ON client.id_client = hour.id_client LEFT JOIN days ON hour.id_day = days.id_day WHERE client.id_client = :id_client";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) :  false;

    }

    public function mdlCountScheduleAdded($idClient){

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT COUNT(*) FROM hour WHERE id_client = :id_client";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client',$idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) :  false;
    }

    public function mdlAddFirstSchedule($idClient, $openL, $closeL, $openM, $closeM, $openW, $closeW, $openJ, $closeJ, $openV, $closeV, $openS, $closeS, $openD, $closeD) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = ("INSERT INTO hour (id_day, id_client, open, close) VALUES (1, :id_client, :openL, :closeL),(2, :id_client, :openM, :closeM),(3, :id_client, :openW, :closeW),(4, :id_client, :openJ, :closeJ),(5, :id_client, :openV, :closeV),(6, :id_client, :openS, :closeS),(7, :id_client, :openD, :closeD)");

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client',$idClient);

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

    public function mdlAddMoreSchedule($idClient, $openL, $closeL, $openM, $closeM, $openW, $closeW, $openJ, $closeJ, $openV, $closeV, $openS, $closeS, $openD, $closeD) {

        $db = new Connection();

        $connection = $db -> get_connection();

        //$connection = $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

        $sql = ("UPDATE hour SET open = :openL, close = :closeL WHERE id_day = 1 AND id_client = :id_client;
        UPDATE hour SET open = :openM, close = :closeM WHERE id_day = 2 AND id_client = :id_client;
        UPDATE hour SET open = :openW, close = :closeW WHERE id_day = 3 AND id_client = :id_client;
        UPDATE hour SET open = :openJ, close = :closeJ WHERE id_day = 4 AND id_client = :id_client;
        UPDATE hour SET open = :openV, close = :closeV WHERE id_day = 5 AND id_client = :id_client;
        UPDATE hour SET open = :openS, close = :closeS WHERE id_day = 6 AND id_client = :id_client;
        UPDATE hour SET open = :openD, close = :closeD WHERE id_day = 7 AND id_client = :id_client;");

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client',$idClient);

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