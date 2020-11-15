<?php

require_once 'connection.php';

class modelProductPrint {

    public function mdlAddProductPrint ($idProduct, $idPrint) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_print (id_product, id_print) VALUES (:idProduct, :idPrint)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':idPrint', $idPrint);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteProductPrint ($idProduct) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_print WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement);
    }

    public function mdlProductPrint($idProduct){

        $db =new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_print FROM product_print WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam('idProduct', $idProduct);
        
        $statement -> execute();

        return ($statement->rowCount() > 0) ?  $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

}
?>