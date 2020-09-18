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

        return ($statement);
    }

    public function mdlDeleteProductSize($idProduct, $idSize) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_size WHERE id_product = :idProduct AND id_size = :idSize";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idSize', $idSize);

        $statement -> execute();

        return ($statement);
    }
}

?>