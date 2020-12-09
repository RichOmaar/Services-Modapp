<?php

require_once 'connection.php';

class modelProductSize {

    public function mdlAddProductSize($idProduct, $idSize) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_size (id_product, id_size) VALUES (:idProduct, :idSize)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlDeleteProductSize($idProduct) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_size WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlProductSize($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_size FROM product_size WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>