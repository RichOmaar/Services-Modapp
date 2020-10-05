<?php

include '../model/products.model.php';
include '../model/productColor.model.php';
include '../model/productPrint.model.php';
include '../model/productSize.model.php';
include '../model/measurements.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addProduct':

        $productName = $_POST['productName']; 
        $price = $_POST['price'];
        $avgDiscount = $_POST['avgDiscount']; 
        $priceDiscount = $_POST['priceDiscount']; 
        $idArticleType = $_POST['idArticleType']; 
        $idCategory = $_POST['idCategory']; 
        $idGender = $_POST['idGender']; 
        $idBody = $_POST['idBody']; 
        $labelStyle = $_POST['labelStyle']; 
        $labelOccasion = $_POST['labelOccasion']; 
        $idLabelSeason = $_POST['idLabelSeason']; 
        $idClient = $_POST['idClient']; 
        $idMeasurement = $_POST['idMeasurement'];
    break;

    case '':
    break;

    case '':
    break;

    case '':
    break;

    default:
}

?>