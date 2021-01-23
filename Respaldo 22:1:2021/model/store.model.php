<?php

require_once 'connection.php';

class modelStore {

    public function mdlAddStore ($store_name, $image, $maps, $idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO store (store_name, image, maps, id_client) VALUES (:store_name, :image, :maps, :id_client)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':store_name', $store_name);

        $statement -> bindParam(':image', $image);

        $statement -> bindParam(':maps', $maps);

        $statement -> bindParam(':id_client', $idClient);

        $statement->execute();

        return $statement->rowCount() > 0 ? true: false;

    }

    public function mdlUpdateStore ( $idStore, $store_name, $image, $maps) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT COUNT(*) AS total FROM store WHERE id_store = :id_store";
        $statement = $connection -> prepare($sql);
        $statement -> bindParam(':id_store', $idStore);
        $statement->execute();
        $count = $statement->fetch(PDO::FETCH_ASSOC);
        if ($count["total"] == 0) {
            return false;
        }


        $sql = "UPDATE store SET store_name = :store_name, image = :image, maps = :maps WHERE id_store = :id_store";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':store_name', $store_name);

        $statement -> bindParam(':image', $image);

        $statement -> bindParam(':maps', $maps);

        $statement -> bindParam(':id_store', $idStore);

        return $statement -> execute();
    }

    public function mdlDeleteStore ($idStore) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM store WHERE id_store = :id_store";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_store', $idStore);

        $statement -> execute();

        return $statement->rowCount() > 0 ? true : false;
    }

    public function mdlInfoStore ($idClient) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM store WHERE id_client = :id_client";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':id_client', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

}

?>