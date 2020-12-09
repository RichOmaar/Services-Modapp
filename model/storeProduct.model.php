<?php

require_once 'connection.php';

class modelStoreProduct {

    public function mdlAddStoreProduct($idStore, $idProduct, $idSize, $quantity) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO store_product(id_store, id_product, id_size, quantity) VALUES (:idStore, :idProduct, :idSize, :quantity)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idStore', $idStore);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> bindParam(':quantity', $quantity);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlUpdateStoreProduct($idStore, $idProduct, $idSize, $quantity, $idStoreProduct) {
    
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE store_product SET id_store = :idStore,id_product = :idProduct,id_size = :idSize,quantity = :quantity WHERE id_storeProduct = :idStoreProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idStore', $idStore);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> bindParam(':quantity', $quantity);

        $statement -> bindParam(':idStoreProduct', $idStoreProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlDeleteStoreProduct($idProduct) {
         
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM store_product WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlStoreInfoStoreProduct($idStore) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_storeProduct, id_store, id_product, id_size, quantity, date FROM store_product WHERE id_store = :idStore";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idStore', $idStore);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlProductInfoStoreProduct($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_storeProduct, id_store, id_product, id_size, quantity, date FROM store_product WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlInfoStoreProduct($idProduct, $idStore) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_storeProduct, id_store, id_product, id_size, quantity, date FROM store_product WHERE id_product = :idProduct AND id_store = :idStore";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idStore', $idStore);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>