<?php

include '../model/prueba.php';

$prueba = new modelPrueba();

$data = $prueba -> mdlPruebaColor();

$dataColors = json_decode($data);

foreach($dataColors as $key => $value) {

    $color = $value[0]['name'];
    $hex = $value[0]['hex'];
    echo json_encode($color);
    echo json_encode($hex);

    $color = new modelColors();

    $result = $color -> mdlAddColor($colorName, $hex);

    if(!$result) {

        $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

        $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    } else {
        
        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

    }

}

?>