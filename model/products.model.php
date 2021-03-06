<?php

require_once 'connection.php';

class modelProduct {

    public function mdlAddProduct($productName, $price, $avgDiscount, $priceDiscount, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement, $articleTypeName) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO products(productName, price, avgDiscount, priceDiscount, id_category, id_gender, id_body, labelStyle, labelOccasion, id_labelSeason, id_client, id_measurement, articleTypeName) VALUES (:productName, :price, :avgDiscount, :priceDiscount, :idCategory, :idGender, :idBody, :labelStyle, :labelOccasion, :idLabelSeason, :idClient, :idMeasurement, :articleTypeName)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':productName', $productName);

        $statement -> bindParam(':price', $price);

        $statement -> bindParam(':avgDiscount', $avgDiscount);

        $statement -> bindParam(':priceDiscount', $priceDiscount);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> bindParam(':idGender', $idGender);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> bindParam(':labelStyle', $labelStyle);

        $statement -> bindParam(':labelOccasion', $labelOccasion);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> bindParam(':idMeasurement', $idMeasurement);

        $statement -> bindParam(':articleTypeName', $articleTypeName);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlUpdateProduct($productName, $price, $avgDiscount, $priceDiscount, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement, $articleTypeName, $idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE products SET productName = :productName, price = :price, avgDiscount = :avgDiscount, priceDiscount = :priceDiscount, id_category = :idCategory, id_gender = :idGender, id_body = :idBody, labelStyle = :labelStyle, labelOccasion = :labelOccasion, id_labelSeason = :idLabelSeason, id_client = :idClient, id_measurement = :idMeasurement, articleTypeName = :articleTypeName WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':productName', $productName);

        $statement -> bindParam(':price', $price);

        $statement -> bindParam(':avgDiscount', $avgDiscount);

        $statement -> bindParam(':priceDiscount', $priceDiscount);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> bindParam(':idGender', $idGender);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> bindParam(':labelStyle', $labelStyle);

        $statement -> bindParam(':labelOccasion', $labelOccasion);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> bindParam(':idMeasurement', $idMeasurement);

        $statement -> bindParam(':articleTypeName', $articleTypeName);
        
        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlDeleteProduct($idProduct) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM products WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? true : false;

    }

    public function mdlAllInfoProduct($idClient) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT products.id_product, products.productName, products.price, products.avgDiscount, products.priceDiscount, products.status, product_images.imageUrl FROM (product_images LEFT JOIN products ON product_images.id_product = products.id_product) LEFT JOIN client ON products.id_client = client.id_client WHERE client.id_client = :idClient AND product_images.ordering = 1";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlInfoProduct($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM products WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;

    }

    public function mdlLastIdProduct() {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM products ORDER BY id_product DESC";

        $statement = $connection -> prepare($sql);

        $statement -> execute();
        
        return ($statement->rowCount() > 0) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

    public function mdlVerifyProductExist($idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT * FROM products WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();
        
        return ($statement->columnCount() >= 1) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

}

?>