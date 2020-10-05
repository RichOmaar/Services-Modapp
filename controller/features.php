<?php

include '../model/articleType.model.php';
include '../model/articleFeatures.model.php';
include '../model/features.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addFeature':

        $idType = $_POST['idType'];
        $brand = $_POST['brand'];
        $material = $_POST['material'];
        $sleeve = $_POST['sleeve'];
        $large = $_POST['large'];


    break;

    case 'showArticleType':
    break;

    case '':
    break;

    case '':
    break;

    case '':
    break;

    default:

        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
                
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
}

?>