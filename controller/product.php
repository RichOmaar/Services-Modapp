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

    case 'addProduct':

        $idRange = $_POST['idRange'];
        $idPartClothing = $_POST['idPartClothing'];
        $idSizeMeasurement = $_POST['idSizeMeasurement'];

        if(strlen($idRange) > 0 && ($idPartClothing) > 0 && ($idSizeMeasurement) > 0) {

            $measurement = new modelMeasurement();

            $dataMeasurement = $measurement -> mdlAddMeasurement($idRange, $idPartClothing, $idSizeMeasurement);

            if(!$dataMeasurement) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                            
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $productName = $_POST['productName']; 
                $price = $_POST['price'];
                $avgDiscount = $_POST['avgDiscount']; 
                $priceDiscount = $_POST['priceDiscount']; 
                $idCategory = $_POST['idCategory']; 
                $idGender = $_POST['idGender']; 
                $idBody = $_POST['idBody']; 
                $labelStyle = $_POST['labelStyle']; 
                $labelOccasion = $_POST['labelOccasion']; 
                $idLabelSeason = $_POST['idLabelSeason']; 
                $idClient = $_POST['idClient'];
                $idMeasurement = $dataMeasurement;
                $articleTypeName = $_POST['articleTypeName'];

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
                    echo json_encode($idCategory);
                    echo json_encode($idGender);
                    echo json_encode($idBody);
                    echo json_encode($labelStyle);
                    echo json_encode($labelOccasion);
                    echo json_encode($idLabelSeason);
                    echo json_encode($idClient);
                    echo json_encode($idMeasurement);
                    echo json_encode($articleTypeName);
*/

                    if(strlen($productName) > 0 && strlen($price) > 0 && strlen($idCategory) > 0 && strlen($idGender) > 0 && strlen($idBody) > 0 && strlen($labelStyle) > 0 && strlen($labelOccasion) > 0 && strlen($idLabelSeason) > 0 && strlen($idClient) > 0 && strlen($articleTypeName) > 0) {

                        $product = new modelProduct();

                        $dataProduct = $product -> mdlAddProduct($productName, $price, $avgDiscount, $priceDiscount, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement, $articleTypeName);

                        $idProduct = $product -> mdlLastIdProduct();

                        $lastIdProduct = $idProduct[0]['id_product'];

                        if(!$dataProduct) {

                            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                
                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                
                        } else {

                            $colors = $_POST['colors'];

                            $color = new modelColors();
                            
                            $_colors = json_decode($colors,true);

                            foreach($_colors as $key => $value) {

                                $colorName = $value['colorName'];
                                $hex = $value['hex'];

                                $result = $color -> mdlAddColor($colorName,$hex);

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

                                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addProductColor));
                        
                                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                        
                                    }

                                }
                            }
                                            
                            $prints = $_POST['prints'];
                            $print = new modelPrints();
                            
                            $_prints = json_decode($prints,true);
                            
                            foreach($_prints as $key => $value) {
                                
                                $printName = $value['name'];
                                $printColors = $value['printColors'];

                                $addPrint = $print -> mdlAddPrint($printName,$printColors);
                                
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
                        
                                        $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addProductPrint));
                        
                                        echo json_encode($response, JSON_UNESCAPED_UNICODE);
                        
                                    }

                                }

                            }
                            
                            $idSize = $_POST['idSize'];
                        
                            $productSize = new modelProductSize();

                            $_idSize = json_decode($idSize,true);

                            foreach($_idSize as $key => $value) {

                                $size = $value['idSize'];

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

                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addProductSize));
                                                
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                }
                            
                            }

                            $storeSize = $_POST['storeSize'];

                            $storeProduct = new modelStoreProduct();

                            $_storeSize = json_decode($storeSize,true);

                            foreach($_storeSize as $key => $value) {

                                $idStore = $value['idStore'];
                                $size = $value['idSize'];
                                $quantity = $value['quantity'];

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

                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addStoreProduct));

                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                                }
                            
                            }
                        
                            $features = $_POST['features'];
                            
                            $feature = new modelFeatures();

                            $_features = json_decode($features,true);
                            
                            foreach($_features as $key => $value){
                                
                                $featureName = $value['featureName'];
                                $value = $value['value'];

                                $addFeatures = $feature -> mdlAddFeature($featureName,$value,$lastIdProduct);

                                $idFeature = $feature -> mdlLastFeatureId();

                                $lasdIdFeature = $idFeature[0]['id_feature'];

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
                    
                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addStoreProduct));

                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                    
                                }
                                
                            }

                            $imageProduct = $_POST['imageProduct'];

                            $image = new modelProductsImages();

                            $_imageProduct = json_decode($imageProduct,true);

                            foreach($_imageProduct as $key => $value){

                                $imageUrl = $value['url'];
                                $order = $value['order'];

                                $addImageProduct = $image -> mdlAddProducImage($imageUrl,$lastIdProduct,$order);

                                if(!$addImageProduct){

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

                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addImageProduct));
                    
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                
                                }

                            }
                            
                        }
                        
                    } else {

                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Product Data Incomplete'));
                
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

    case 'updateProduct':

        $idProduct = $_POST['idProduct'];

        if(strlen($idProduct) > 0){

            $product = new modelProduct();

            $pastProductExist = $product -> mdlVerifyProductExist($idProduct);

            if($pastProductExist == false){
                
                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    
                echo json_encode($response, JSON_UNESCAPED_UNICODE); 
                
            } else{

                $idRange = $_POST['idRange'];
                $idPartClothing = $_POST['idPartClothing'];
                $idSizeMeasurement = $_POST['idSizeMeasurement'];

                if(strlen($idRange) > 0 && ($idPartClothing) > 0 && ($idSizeMeasurement) > 0) {

                    $measurement = new modelMeasurement();

                    $dataMeasurement = $measurement -> mdlAddMeasurement($idRange, $idPartClothing, $idSizeMeasurement);

                    if(!$dataMeasurement) {

                        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                    
                        echo json_encode($response, JSON_UNESCAPED_UNICODE);

                    } else {

                        $productName = $_POST['productName']; 
                        $price = $_POST['price'];
                        $avgDiscount = $_POST['avgDiscount']; 
                        $priceDiscount = $_POST['priceDiscount']; 
                        $idCategory = $_POST['idCategory']; 
                        $idGender = $_POST['idGender']; 
                        $idBody = $_POST['idBody']; 
                        $labelStyle = $_POST['labelStyle']; 
                        $labelOccasion = $_POST['labelOccasion']; 
                        $idLabelSeason = $_POST['idLabelSeason']; 
                        $idClient = $_POST['idClient'];
                        $idMeasurement = $dataMeasurement;
                        $articleTypeName = $_POST['articleTypeName'];

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
                            echo json_encode($idCategory);
                            echo json_encode($idGender);
                            echo json_encode($idBody);
                            echo json_encode($labelStyle);
                            echo json_encode($labelOccasion);
                            echo json_encode($idLabelSeason);
                            echo json_encode($idClient);
                            echo json_encode($idMeasurement);
                            echo json_encode($articleTypeName);
        */

                            if(strlen($productName) > 0 && strlen($price) > 0 && strlen($idCategory) > 0 && strlen($idGender) > 0 && strlen($idBody) > 0 && strlen($labelStyle) > 0 && strlen($labelOccasion) > 0 && strlen($idLabelSeason) > 0 && strlen($idClient) > 0 && strlen($articleTypeName) > 0) {


                                $dataProduct = $product -> mdlAddProduct($productName, $price, $avgDiscount, $priceDiscount, $idCategory, $idGender, $idBody, $labelStyle, $labelOccasion, $idLabelSeason, $idClient, $idMeasurement, $articleTypeName);

                                $idProduct = $product -> mdlLastIdProduct();

                                $lastIdProduct = $idProduct[0]['id_product'];

                                if(!$dataProduct) {

                                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                                        
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                        
                                } else {

                                    $colors = $_POST['colors'];

                                    $color = new modelColors();
                                    
                                    $_colors = json_decode($colors,true);

                                    foreach($_colors as $key => $value) {

                                        $colorName = $value['colorName'];
                                        $hex = $value['hex'];

                                        $result = $color -> mdlAddColor($colorName,$hex);

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

                                                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addProductColor));
                                
                                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                
                                            }

                                        }
                                    }
                                                    
                                    $prints = $_POST['prints'];
                                    $print = new modelPrints();
                                    
                                    $_prints = json_decode($prints,true);
                                    
                                    foreach($_prints as $key => $value) {
                                        
                                        $printName = $value['name'];
                                        $printColors = $value['printColors'];

                                        $addPrint = $print -> mdlAddPrint($printName,$printColors);
                                        
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
                                
                                                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addProductPrint));
                                
                                                echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                
                                            }

                                        }

                                    }
                                    
                                    $idSize = $_POST['idSize'];
                                
                                    $productSize = new modelProductSize();

                                    $_idSize = json_decode($idSize,true);

                                    foreach($_idSize as $key => $value) {

                                        $size = $value['idSize'];

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

                                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addProductSize));
                                                        
                                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                        }
                                    
                                    }

                                    $storeSize = $_POST['storeSize'];

                                    $storeProduct = new modelStoreProduct();

                                    $_storeSize = json_decode($storeSize,true);

                                    foreach($_storeSize as $key => $value) {

                                        $idStore = $value['idStore'];
                                        $size = $value['idSize'];
                                        $quantity = $value['quantity'];

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

                                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addStoreProduct));

                                            echo json_encode($response, JSON_UNESCAPED_UNICODE);

                                        }
                                    
                                    }
                                
                                    $features = $_POST['features'];
                                    
                                    $feature = new modelFeatures();

                                    $_features = json_decode($features,true);
                                    
                                    foreach($_features as $key => $value){
                                        
                                        $featureName = $value['featureName'];
                                        $value = $value['value'];

                                        $addFeatures = $feature -> mdlAddFeature($featureName,$value,$lastIdProduct);

                                        $idFeature = $feature -> mdlLastFeatureId();

                                        $lasdIdFeature = $idFeature[0]['id_feature'];

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
                            
                                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addStoreProduct));

                                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                            
                                        }
                                        
                                    }

                                    $imageProduct = $_POST['imageProduct'];

                                    $image = new modelProductsImages();

                                    $_imageProduct = json_decode($imageProduct,true);

                                    foreach($_imageProduct as $key => $value){

                                        $imageUrl = $value['url'];
                                        $order = $value['order'];

                                        $addImageProduct = $image -> mdlAddProducImage($imageUrl,$lastIdProduct,$order);

                                        if(!$addImageProduct){

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

                                            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $addImageProduct));
                            
                                            echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                        
                                        }

                                    }
                                    
                                }
                                
                            } else {

                                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Product Data Incomplete'));
                        
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

                $existNewProduct = $product -> mdlVerifyProductExist($lastIdProduct);

                if($existNewProduct == false){

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Constants::BAD_RESPONSE_DESCRIPTION'));
            
                    echo json_encode($response, JSON_UNESCAPED_UNICODE); 

                } else{

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

                }
            }

        } else{

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
    
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 

        }
        
    break;

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

    case 'products':
        
        $idClient = $_POST['idClient'];

        if(strlen($idClient) > 0) {

            $product = new modelProduct();

            $allInfoProducts = $product -> mdlAllInfoProduct($idClient);

            if(!$allInfoProducts) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_POST_RESPONSE_NO_PRODUCT));
        
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $allInfoProducts));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }
            
        } else {
                    
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);
            
        }

    break;

    case 'product':
        
    break;

    default:
    
        $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

        echo json_encode($response, JSON_UNESCAPED_UNICODE);

}

?>
