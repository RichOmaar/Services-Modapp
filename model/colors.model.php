<?php

require_once 'connection.php';

class modelColors {

    public function mdlAddColor($colorName, $hex) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO colors(colorName, hex) VALUES (:colorName, :hex)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam('colorName' ,$colorName);

        $statement -> bindParam(':hex', $hex);
        
        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateColor($colorName, $hex, $idColor) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE colors SET colorName = :colorName, hex = :hex WHERE id_color = :idColor";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':colorName' ,$colorName);

        $statement -> bindParam(':hex', $hex);
        
        $statement -> bindParam(':idColor', $idColor);
        
        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteColor($idColor) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM colors WHERE id_color = :idColor";
        
        $statement = $connection -> prepare($sql);
        
        $statement -> bindParam(':idColor', $idColor);
        
        $statement -> execute();

        return ($statement);

    }

    public function mdlGeneralInfoColor() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM colors";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlInfoColor($idColor) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_color, colorName, hex FROM colors WHERE id_color = :idColor";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idColor', $idColor);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlAddProductColor($idColor,$idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_color(id_product,id_color) VALUES (:idProduct,:idColor)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam('idProduct', $idProduct);

        $statement -> bindParam('idColor', $idColor);

        $statement -> execute();

        return ($statement);

    }
}
?>