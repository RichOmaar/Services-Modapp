<?php

require_once 'connection.php';

class modelPrints {

    public function mdlAddPrint($printName,$printColors) {

        $db = new Connection();
        
        $connection = $db -> get_connection();

        $sql = "INSERT INTO prints(printName,printColors) VALUES (:printName,:printColors)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':printName', $printName);
        
        $statement -> bindParam(':printColors', $printColors);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlUpdatePrint($printName,$idPrint,$printColors) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE prints SET printName = :printName, printColors = :printColors WHERE id_print = :idPrint";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':printName', $printName);
        
        $statement -> bindParam(':printColors', $printColors);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlDelePrint($idPrint) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM prints WHERE id_print = :idPrint";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;
    }

    public function mdlGeneralInfoPrint() {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM prints";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlAllPrint($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT prints.id_print, prints.printName, prints.printColors FROM product_print LEFT JOIN prints ON product_print.id_print = prints.id_print WHERE product_print.id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
        
    }

    public function mdlInfoPrint($idPrint) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_print, printName, printColors FROM prints WHERE id_print = :idPrint";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlLastPrintId() {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM prints ORDER BY id_print DESC";

        $statement = $connection -> prepare($sql);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlAddProductPrint($idProduct,$idPrint) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_print(id_product, id_print) VALUES (:idProduct,:idPrint)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlDeleteProductPrint($idProduct,$idPrint) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_print(id_product, id_print) VALUES (:idProduct,:idPrint)";

        $sql = "DELETE FROM product_print WHERE id_product = :idProduct AND id_print = :idPrint)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }
}

?>