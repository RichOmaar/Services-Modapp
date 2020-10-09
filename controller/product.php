<?php

include '../model/products.model.php';
include '../model/productColor.model.php';
include '../model/productPrint.model.php';
include '../model/productSize.model.php';
include '../model/measurements.model.php';
include '../model/colors.model.php';
include '../model/prints.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addProduct':
        $idRange = $_POST['idRange'];
        $idPartClothing = $_POST['idPartClothing'];
        $idSize = $_POST['idSize'];

        if(strlen($idRange) > 0 && ($idPartClothing) > 0 && ($idSize) > 0) {

            $measurement = new modelMeasurement();

            $dataMeasurement = $measurement -> mdlAddMeasurement($idRange, $idPartClothing, $idSize);

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

                    if(strlen($productName) > 0 && strlen($price) > 0 && strlen($idArticleType) > 0 && strlen($idCategory) > 0 && strlen($idGender) > 0 && strlen($idBody) > 0 && strlen($labelStyle) > 0 && strlen($labelOccasion) > 0 && strlen($idLabelSeason) > 0 && strlen($idClient) > 0) {
    
                        $product = new modelProduct();
    
                        $dataProduct = $product -> mdlAddProduct($productName, $price, $avgDiscount, $priceDiscount, $idArticleType, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement);
        
                        $idProduct = $product -> mdlLastIdProduct();

                        $lastIdProduct = $idProduct[0]['id_product'];

                        if(!$dataProduct) {
    
                            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                
                        } else {

                            $colorName = 'NEGRO';
                            $hex = '000000';

                            $color = new modelColors();

                            $result = $color -> mdlAddColor($colorName, $hex);

                            $idColor = $color -> mdlIdColor();

                            $lastIdColor = $idColor[0]['id_color'];

                            echo json_encode($lastIdColor);

                                if(!$result) {

                                    $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

                                    $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

                                    $deleteColor = $color -> mdlDeleteColor($lastIdColor);

                                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                                } else {
                                    
                                    $addProductColor = $color -> mdlAddProductColor($lastIdColor,$lastIdProduct);

                                    if(!$addProductColor) {
                        
                                        $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

                                        $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

                                        $deleteColor = $color -> mdlDeleteColor($lastIdColor);

                                        $deleteProductColor = $color -> mdlDeleteProductColor($lastIdColor,$lastIdProduct);

                                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                            
                                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                        
                                    } else {

                                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
                        
                                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                        
                                    }
                                }

                            /* FOREACH PARA INSERTAR LOS COLORES
                            $colors = $_POST['colors'];

                            $dataColors = json_decode($colors);

                            foreach($dataColors as $key => $value) {

                                $color = $value['name'];
                                $hex = $value['hex'];

                                $color = new modelColors();

                                $result = $color -> mdlAddColor($colorName, $hex);

                                if(!$result) {
/*
                                    $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

                                    $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

                                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                                } else {
                                    
                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                                }

                            }
                
                            //$idFeature = $_POST['idFeature'];
                            */

                            /*AQUI IRÍA EL FOREACH DE LOS PRINT
                            $prints = $_POST['prints'];
                            */

                            $printName = 'Animal print';

                            $print = new modelPrints();

                            $addPrint = $print -> mdlAddPrint($printName);

                            $idPrint = $print -> mdlLastPrintId();

                            $lastIdPrint = $idPrint[0]['id_print'];

                                if(!$addPrint) {

                                    $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);

                                    $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

                                    $deleteColor = $color -> mdlDeleteColor($lastIdColor);

                                    $deleteProductColor = $color -> mdlDeleteProductColor($lastIdColor,$lastIdProduct);

                                    $deletePrint = $print -> mdlDelePrint($lastIdPrint);

                                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                        
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    
                                } else {
                    
                                    $addProductPrint = $print -> mdlAddProductPrint($lastIdProduct,$lastIdPrint);

                                    if(!$addProductPrint) {

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
                    
                                }
////////////////////////////////////////////////// AQUI VA LO SIGUIENTE ////////////////////////////////////
                        }
    
                    } else {
    
                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
                        echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                    }
    
                } else {

                    $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);

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