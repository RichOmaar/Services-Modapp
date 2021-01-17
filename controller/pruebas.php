<?php

include '../model/features.model.php';

$idProduct = $_POST['idProduct'];

$features = new modelFeatures();

$deteleFeatures = $features -> mdlDeleteFeature($idProduct);

if(!$deteleFeatures) {

    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
        
    echo json_encode($response, JSON_UNESCAPED_UNICODE);

} else {

    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteProductImage));

    echo json_encode($response, JSON_UNESCAPED_UNICODE);

}

?>