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

$idRange = $_POST['idRange'];
$idPartClothing = $_POST['idPartClothing'];
$idSize = $_POST['idSize'];
$array = array();

$measurement = new modelMeasurement();

$i = 0;

foreach($idSize as $key => $value) {

    $size = $idSize[$i]['idSize'];

    $dataMeasurement = $measurement -> mdlAddMeasurement($idRange, $idPartClothing, $idSize);

    echo json_encode($size);
    echo json_encode($idRange);
    echo json_encode($idPartClothing);
    
    if(!$dataMeasurement) {

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
            
        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {

        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }
    $i++;
}
?>
