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
include '../model/productsImages.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'deleteProduct':

        $idProduct = $_POST['idProduct'];

        if(strlen($idProduct) > 0) {

            $product = new modelProduct();

            $verifyProduct = $product -> mdlVerifyProductExist($idProduct);

            if($verifyProduct == false) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE_NO_PRODUCT));
        
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $productColor = new modelProductColor();
                $color = new modelColors();

                $colors = $productColor -> mdlProductColor($idProduct);
                
                $deleteProductColor = $productColor -> mdlDeleteProductColor($idProduct);

                $i = 0;

                foreach($colors as $key => $value){

                    $idColor = $colors[$i]['id_color'];

                    $deleteColor = $color -> mdlDeleteColor($idColor);

                    if(!$deleteColor) {

                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                            
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    } else {
        
                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteColor));
        
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    }
                    $i++;
                }

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
        
                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deletePrint));
        
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        
                    }

                    $j++;
                
                }

                $productSize = new modelProductSize();

                $deleteProductSize = $productSize -> mdlDeleteProductSize($idProduct);
                
                if(!$deleteProductSize) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteProductSize));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

                $storeProduct = new modelStoreProduct();

                $deleteStoreProduct = $storeProduct -> mdlDeleteStoreProduct($idProduct);

                if(!$deleteStoreProduct) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteStoreProduct));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

                $imageProduct = new modelProductsImages();

                $deleteProductImage = $imageProduct -> mdlDeleteProducImage($idProduct);

                if(!$deleteProductImage) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteProductImage));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

                $features = new modelFeatures();

                $deteleFeatures = $features -> mdlDeleteFeature($idProduct);

                if(!$deteleFeatures) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteProductImage));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

                $measurement = new modelMeasurement();

                $idMeasurement = $measurement -> mdlGetIdMeasurement($idProduct);

                $deleteProduct = $product -> mdlDeleteProduct($idProduct);

                if(!$deleteProduct) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteProduct));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }

                $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement[0]['id_measurement']);

                if(!$deleteMeasuerement) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $deleteMeasuerement));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }
            }

        } else {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }   

    break;

    default:
    
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

}

?>