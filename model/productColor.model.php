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

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlDeleteProductColor($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_color WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlProductColor($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_color FROM product_color WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }
}

?>