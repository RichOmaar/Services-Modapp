<?php

require_once 'connection.php';

class modelProduct {

    public function mdlAddProduct($productName, $price, $avgDiscount, $priceDiscount, $idArticleType, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "INSERT INTO products(productName, price, avgDiscount, priceDiscount, id_articleType, id_category, id_gender, id_body, labelStyle, labelOccasion, id_labelSeason, id_client, id_measurement) VALUES (:productName, :price, :avgDiscount, :priceDiscount, :idArticleType, :idCategory, :idGender, :idBody, :labelStyle, :labelOccasion, :idLabelSeason, :idClient, :idMeasurement)";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':productName', $productName);

        $statement -> bindParam(':price', $price);

        $statement -> bindParam(':avgDiscount', $avgDiscount);

        $statement -> bindParam(':priceDiscount', $priceDiscount);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> bindParam(':idGender', $idGender);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> bindParam(':labelStyle', $labelStyle);

        $statement -> bindParam(':labelOccasion', $labelOccasion);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> bindParam(':idMeasurement', $idMeasurement);

        $statement -> execute();

        return($statement);

    }

    public function mdlUpdateProduct($productName, $price, $avgDiscount, $priceDiscount, $idArticleType, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement, $idProduct) {

        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "UPDATE products SET productName = :productName, price = :price, avgDiscount = :avgDiscount, priceDiscount = :priceDiscount, id_articleType = :idArticleType, id_category = :idCategory, id_gender = :idGender, id_body = :idBody, labelStyle = :labelStyle, labelOccasion = :labelOccasion, id_labelSeason = :idLabelSeason, id_client = :idClient, id_measurement = :idMeasurement WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':productName', $productName);

        $statement -> bindParam(':price', $price);

        $statement -> bindParam(':avgDiscount', $avgDiscount);

        $statement -> bindParam(':priceDiscount', $priceDiscount);

        $statement -> bindParam(':idArticleType', $idArticleType);

        $statement -> bindParam(':idCategory', $idCategory);

        $statement -> bindParam(':idGender', $idGender);

        $statement -> bindParam(':idBody', $idBody);

        $statement -> bindParam(':labelStyle', $labelStyle);

        $statement -> bindParam(':labelOccasion', $labelOccasion);

        $statement -> bindParam(':idLabelSeason', $idLabelSeason);

        $statement -> bindParam(':idClient', $idClient);

        $statement -> bindParam(':idMeasurement', $idMeasurement);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement);
    }

    public function mdlDeleteProduct($idProduct) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "DELETE FROM products WHERE id_product = :idProduct";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idProduct', $idProduct);

        $statement -> execute();

        return ($statement);
    }

    public function mdlGeneralInfoProduct($idClient) {
        
        $db = new Connection();

        $connection = $db -> get_connection();

        $sql = "SELECT id_product, productName, price, avgDiscount, priceDiscount, id_articleType, id_category, id_gender, id_body, labelStyle, labelOccasion, id_labelSeason, id_client, id_measurement, status FROM products WHERE id_client = :idClient";

        $statement = $connection -> prepare($sql);

        $statement -> bindParam(':idClient', $idClient);

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
        
        return ($statement->rowCount() == 1) ? $statement->fetchAll(PDO::FETCH_ASSOC) : false;
    }

}

?>