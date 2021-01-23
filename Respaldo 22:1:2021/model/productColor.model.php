<?php

require_once 'connection.php';

class modelProductColor {

    public function mdlAddProductColor($idProduct, $idColor) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_color (id_product, id_color) VALUES (:idProduct, :idColor)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idColor', $idColor);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteProductColor($idProduct, $idColor) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_color WHERE id_product = :idProduct AND id_color = :idColor";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idColor', $idColor);

        $statement -> execute();

        return ($statement);
    }
}

?>