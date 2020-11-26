<?php

require_once 'connection.php';

class modelProductRating {

    public function mdlAddProductRating($idUser, $idProduct, $content, $rate) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO `product_rating` ( `id_user`, `id_product`, `content`, `rate`) VALUES (:idUser, :idProduct, :content, :rate)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser', $idUser);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':content', $content);

        $statement -> bindParam(':rate', $rate);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateProductRating($idUser, $idProduct, $content, $rate, $idProductRating) {
    
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE `product_rating` SET `id_user` = :idUser, `id_product`= :idProduct,`content` = :content,`rate` = :rate WHERE id_productRating = :idProductRating";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser', $idUser);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':content', $content);

        $statement -> bindParam(':rate', $rate);

        $statement -> bindParam(':idProductRating', $idProductRating);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteProductRating($idProduct,$idUser) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_rating WHERE id_user = :idUser AND id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser', $idUser);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoProductRating ($idProductRating) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM product_rating WHERE id_productRating = :idProductRating";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProductRating', $idProductRating);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlInfoProductRating ($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM product_rating WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

}
?>