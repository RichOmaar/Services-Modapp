<?php
include '../model/products.model.php';
include '../model/productColor.model.php';
include '../model/productPrint.model.php';
include '../model/productSize.model.php';
include '../model/measurements.model.php';
include '../model/colors.model.php';
include '../model/prints.model.php';
include '../model/storeProduct.model.php';
include '../model/features.model.php';
include '../model/articleFeatures.model.php';

$idProduct = $_POST['idProduct'];

$productPrint = new modelProductPrint();

$print = new modelPrints();

$prints = $productPrint -> mdlProductPrint($idProduct);

$j = 0;

foreach($prints as $key => $value){

    $deleteProductPrint = $productPrint -> mdlDeleteProductPrint($idProduct);

    $idPrint = $prints[$j]['id_print'];

    $deletePrint = $print -> mdlDelePrint($idPrint);

    if(!$deletePrint) {

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
            
        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {

        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }
    $j++;
}

?>
