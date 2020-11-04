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

$idSize = $_POST['idSize'];
                        
//$dataSizes = json_decode($idSize);

$productSize = new modelProductSize();

$i = 0;

foreach($idSize as $key => $value) {

    $size = $idSize[$i]['idSize'];

    echo json_encode($size);

    $addProductSize = $productSize -> mdlAddProductSize($lastIdProduct,$size);

    if(!$addProductSize) {

        $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

        $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

        $deleteColor = $color -> mdlDeleteColor($lastIdColor);

        $deleteProductColor = $color -> mdlDeleteProductColor($lastIdColor,$lastIdProduct);

        $deletePrint = $print -> mdlDelePrint($lastIdPrint);

        $deleteProductPrint = $print -> mdlDeleteProductPrint($lastIdProduct,$lastIdPrint);
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
            
        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {

        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
                    
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
    $i++;
}


$storeSize = $_POST['storeSize'];
//$dataStores = json_decode($stores);

$storeProduct = new modelStoreProduct();

$j = 0;

foreach($storeSize as $key => $value) {

    $idStore = $storeSize[$j]['idStore'];
    $size = $storeSize[$j]['idSize'];
    $quantity = $storeSize[$j]['quantity'];
    
    echo json_encode($idStore);
    echo json_encode($size);
    echo json_encode($quantity);
    echo json_encode($lastIdProduct);

    $addStoreProduct = $storeProduct -> mdlAddStoreProduct($idStore,$lastIdProduct,$size,$quantity);

    if(!$addStoreProduct) {
        
        $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

        $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

        $deleteColor = $color -> mdlDeleteColor($lastIdColor);

        $deleteProductColor = $color -> mdlDeleteProductColor($lastIdColor,$lastIdProduct);

        $deletePrint = $print -> mdlDelePrint($lastIdPrint);

        $deleteProductPrint = $print -> mdlDeleteProductPrint($lastIdProduct,$lastIdPrint);

        $deleteProductSize = $productSize -> mdlDeleteProductSize($lastIdProduct,$idSize);
        
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
            
        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {

        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }
    $j++;
}

?>
