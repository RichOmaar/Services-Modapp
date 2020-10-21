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

                            $colorName = $_POST['colorName'];
                            $hex = $_POST['hex'];

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
                            $color = $_POST['colors'];

                            $dataColors = json_decode($colors);

                            $color = new modelColors();

                            foreach($dataColors as $key => $value) {

                                $color = $value['color'];
                                
                                $hex = $value['hex'];

                                $result = $color -> mdlAddColor($colorName, $hex);

                                $idColor = $color -> mdlIdColor();

                                $lastIdColor = $idColor[0]['id_color'];

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

                            }
                */
                            

                /*          AQUI IRÍA EL FOREACH DE LOS PRINT
                           
                            $prints = $_POST['prints'];

                            $dataPrint = json_decode($prints);

                            $print = new modelPrints();

                            foreach($dataPrint as $key => $value) {
                                
                                $printName = $value['name'];

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

                            }

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
                            $idSize = $_POST['idSize'];
                            
                            $productSize = new modelProductSize();

                            $addProductSize = $productSize -> mdlAddProductSize($lastIdProduct,$idSize);

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

                            $idStore = $_POST['idStore'];
                            $quantity = $_POST['quantity'];

                            $storeProduct = new modelStoreProduct();

                            $addStoreProduct = $storeProduct -> mdlAddStoreProduct($idStore,$lastIdProduct,$idSize,$quantity);

                            if(!$addStoreProduct) {

                                echo json_encode($addStoreProduct);
                                
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

                            /*
                            $idSize = $_POST['idSize'];
                            
                            $dataSizes = json_decode($idSize);

                            $productSize = new modelProductSize();

                            foreach($dataSizes as $key => $value) {

                                $idSize = $value['idSize'];

                                $addProductSize = $productSize -> mdlAddProductSize($lastIdProduct,$idSize);

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

                                    $stores = $_POST['stores'];

                                    $dataStores = json_decode($stores);

                                    $storeProduct = new modelStoreProduct();

                                    foreach($dataStores as $key => $value) {

                                        $idStore = $value['idStore'];
                                        $quantity = $value['quantity'];

                                        $addStoreProduct = $storeProduct -> mdlAddStoreProduct($idStore,$lastIdProduct,$idSize,$quantity);

                                        if(!$addStoreProduct) {

                                            echo json_encode($addStoreProduct);
                                            
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
                                    }
                    
                                }
                            }
                            */
                        
                            $featureName = $_POST['featureName'];
                            $valueFeature = $_POST['valueFeature'];

                            echo json_encode($valueFeature);
                            
                            $features = new modelFeatures();

                            $addFeatures = $features -> mdlAddFeature($featureName,$valueFeature);

                            $lasdIdFeature = $features -> mdlLastFeatureId();

                            if(!$addFeatures) {

                                echo json_encode($addStoreProduct);
                                
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
                
                                $articleFeatures = new modelArticleFeatures();

                                $addArticleFeature = $articleFeatures -> mdlAddArticleFeature($idArticleType,$lasdIdFeature);

                                if(!$addArticleFeature) {

                                    //echo json_encode($addStoreProduct);
                                    
                                    $deleteProduct = $product -> mdlDeleteProduct($lastIdProduct);
    
                                    $deleteMeasuerement = $measurement -> mdlDeleteMeasurement($idMeasurement);
    
                                    $deleteColor = $color -> mdlDeleteColor($lastIdColor);
    
                                    $deleteProductColor = $color -> mdlDeleteProductColor($lastIdColor,$lastIdProduct);
    
                                    $deletePrint = $print -> mdlDelePrint($lastIdPrint);
    
                                    $deleteProductPrint = $print -> mdlDeleteProductPrint($lastIdProduct,$lastIdPrint);
    
                                    $deleteProductSize = $productSize -> mdlDeleteProductSize($lastIdProduct,$idSize);

                                    $deleteFeature = $features -> mdlDeleteFeature($lasdIdFeature);
                                    
                                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                        
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    
                                } else {
                    
                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
                    
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                    
                                }
                
                            }

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