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
        
        echo json_encode($idRange);
        echo json_encode($idPartClothing);
        echo json_encode($idSizeMeasurement);

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

                            $colors = $_POST['colors'];

                            $color = new modelColors();

                            $i = 0;

                            foreach($colors as $key => $value) {

                                $colorName = $colors[$i]['colorName'];

                                $hex = $colors[$i]['hex'];
                                
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
                                $i++;
                            }
                
                            /*AQUI IRÍA EL FOREACH DE LOS PRINT*/
                            
                            $prints = $_POST['prints'];
                            
                            $print = new modelPrints();

                            $i = 0;

                            foreach($prints as $key => $value) {

                                $printName = $prints[$i]['name'];

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

                                    echo json_encode('Numero'.$i);
                    
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
                                $i++;
                            }
                            
                            $idSize = $_POST['idSize'];
                        
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

                            $storeProduct = new modelStoreProduct();

                            $j = 0;

                            foreach($storeSize as $key => $value) {

                                $idStore = $storeSize[$j]['idStore'];
                                $size = $storeSize[$j]['idSize'];
                                $quantity = $storeSize[$j]['quantity'];

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
                        
                            $featureName = $_POST['featureName'];
                            $valueFeature = $_POST['valueFeature'];
                            
                            $features = new modelFeatures();

                            $addFeatures = $features -> mdlAddFeature($featureName,$valueFeature);

                            $idFeature = $features -> mdlLastFeatureId();

                            $lasdIdFeature = $idFeature[0]['id_feature'];

                            echo json_encode($lasdIdFeature);

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

                            $imageProduct = $_POST['imageProduct'];

                            $image = new modelProductsImages();

                            $i = 0;

                            foreach($imageProduct as $key => $value){

                                $imageUrl = $imageProduct[$i]['url'];
                                $order = $imageProduct[$i]['order'];

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

                                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
                    
                                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
                                }
                                $i++;
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
    break;

    case 'deleteProduct':

        $idProduct = $_POST['idProduct'];

        if(strlen($idProduct) > 0) {
            echo json_encode($idProduct);

            $productColor = new modelProductColor();
            $color = new modelColors();

            $colors = $productColor -> mdlProductColor($idProduct);

            //echo json_encode($colors);
            
            $deleteProductColor = $productColor -> mdlDeleteProductColor($idProduct);

            $i = 0;

            foreach($colors as $key => $value){

                $idColor = $colors[$i]['id_color'];

                $deleteColor = $color -> mdlDeleteColor($idColor);

                if(!$deleteColor) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                } else {
    
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
    
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
    
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
    
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

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

            $storeProduct = new modelStoreProduct();

            $deleteStoreProduct = $storeProduct -> mdlDeleteStoreProduct($idProduct);

            if(!$deleteStoreProduct) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

            $imageProduct = new modelProductsImages();

            $deleteProductImage = $imageProduct -> mdlDeleteProducImage($idProduct);

            if(!$deleteProductImage) {

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

    break;

    case 'products':
    break;

    case 'product':
    break;

    default:
}

?>