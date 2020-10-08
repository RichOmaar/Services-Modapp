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
        $idRange = $_POST['idRange'];
        $idPartClothing = $_POST['idPartClothing'];
        $idSize = $_POST['idSize'];

        if(strlen($idRange) > 0 && ($idPartClothing) > 0 && ($idSize) > 0) {

            $addMeasurement = new modelMeasurement();

            $dataMeasurement = $addMeasurement -> mdlAddMeasurement($idRange, $idPartClothing, $idSize);

            if(!$dataMeasurement) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

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
                $idMeasurement = $dataMeasurement;

                if($avgDiscount || $priceDiscount != '') {

                    if($avgDiscount === '') {

                        $avgDiscount = NULL;
                    }
    
                    if($priceDiscount === '') {
    
                        $priceDiscount = NULL;
    
                    }
                    /*
                    echo json_encode($productName); 
                    echo json_encode($price); 
                    echo json_encode($avgDiscount); 
                    echo json_encode($priceDiscount); 
                    echo json_encode($idArticleType); 
                    echo json_encode($idCategory); 
                    echo json_encode($idGender); 
                    echo json_encode($idBody); 
                    echo json_encode($labelStyle); 
                    echo json_encode($labelOccasion); 
                    echo json_encode($idLabelSeason); 
                    echo json_encode($idClient); 
                    echo json_encode($idMeasurement);
                    */
                    if(strlen($productName) > 0 && strlen($price) > 0 && strlen($idArticleType) > 0 && strlen($idCategory) > 0 && strlen($idGender) > 0 && strlen($idBody) > 0 && strlen($labelStyle) > 0 && strlen($labelOccasion) > 0 && strlen($idLabelSeason) > 0 && strlen($idClient) > 0) {
    
                        $addProduct = new modelProduct();
    
                        $dataProduct = $addProduct -> mdlAddProduct($productName, $price, $avgDiscount, $priceDiscount, $idArticleType, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement);
    
                        echo json_encode('aqui');
    
                        if(!$dataProduct) {
    
                            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                
                        } else {
                
                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
                
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                
                        }
    
                    } else {
    
                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
                        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                    }
    
                } else {

                    $deleteMeasuerement = $addMeasurement -> mdlDeleteMeasurement($idMeasurement);

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => '$avgDiscount and $priceDiscount are empty'));
                
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

            }
        
        } else {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        } 

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