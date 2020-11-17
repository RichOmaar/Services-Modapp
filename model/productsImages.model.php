<?php

require_once 'connection.php';

class modelProductsImages {

    public function mdlAddProducImage($imageUrl, $idProduct, $ordering) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO product_images (imageUrl, id_product, ordering) VALUES (:imageUrl, :idProduct, :ordering)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':imageUrl', $imageUrl);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':ordering', $ordering);

        $statement -> execute();

        return ($statement);
    }

    public function mdlUpdateProducImage($idProductImage, $imageUrl, $idProduct, $ordering) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE product_images SET imageUrl = :imageUrl,id_product = :idProduct,ordering = :ordering WHERE id_productImage = :idProductImage";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':imageUrl', $imageUrl);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> bindParam(':ordering', $ordering);

        $statement -> bindParam(':idProductImage', $idProductImage);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteProducImage($idProduct) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM product_images WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoProducImage($idProduct) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_productImage, imageUrl, id_product, ordering FROM product_images WHERE id_product = :idProduct ORDER BY ordering ASC";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;    
    }

    public function mdlInfoProducImage($idProductImage) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_productImage, imageUrl, id_product, ordering FROM product_images WHERE id_productImage = :idProductImage";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProductImage', $idProductImage);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;    
    }
}

?>