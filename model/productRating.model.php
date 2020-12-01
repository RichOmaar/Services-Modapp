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

    public function mdlUpdateProductRating($idUser,$content,$rate,$idProductRating) {
    
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE product_rating SET content = :content, rate = :rate WHERE id_productRating = :idProductRating AND id_user = :idUser";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser', $idUser);

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

    public function mdlAllProductRating ($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT user.username, user.image, product_rating.rate, product_rating.content, product_rating.date FROM product_rating LEFT JOIN user ON product_rating.id_user = user.id_user WHERE product_rating.id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlInfoProductRating ($idUser,$idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT user.username, user.image, product_rating.rate, product_rating.content, product_rating.date FROM product_rating LEFT JOIN user ON product_rating.id_user = user.id_user WHERE product_rating.id_user = :idUser AND product_rating.id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idUser', $idUser);
       
        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

}
?>