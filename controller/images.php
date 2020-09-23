<?php

include '../model/productsImages.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    $idClient = $_POST['idClient'];
    $action = $_POST['action'];

    switch($action) {

        case 'addProducImage':

            $imageUrl = $_POST['imageUrl'];
            $idProduct = $_POST['idProduct'];
            $ordering = $_POST['ordering'];

            if(strlen($idProduct) > 0 && strlen($imageUrl) > 0 && strlen($ordering) > 0) {

                $addImage = new modelProductsImages();

                $data = $addImage -> mdlAddProducImage($imageUrl, $idProduct, $ordering);

                if(!$data) {

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

        case 'updateProducImage':

            $idProductImage = $_POST['idProductImage'];
            $imageUrl = $_POST['imageUrl'];
            $idProduct = $_POST['idProduct'];
            $ordering = $_POST['ordering'];

            if(strlen($idProduct) > 0 && strlen($imageUrl) > 0 && strlen($ordering) > 0 && strlen($idProductImage) > 0) {

                $updateImage = new modelProductsImages();

                $data = $updateImage -> mdlUpdateProducImage($idProductImage, $imageUrl, $idProduct, $ordering);

                if(!$data) {

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

        case 'deleteProducImage':

            $idProductImage = $_POST['idProductImage'];

            if(strlen($idProductImage) > 0) {
                
                $deleteImage = new modelProductsImages();

                $data = $deleteImage -> mdlDeleteProducImage($idProductImage);

                if(!$data) {

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

        case 'images':

            $idProduct = $_POST['idProduct'];

            if(strlen($idProduct) > 0) {

                $images = new modelProductsImages();

                $data = $images -> mdlGeneralInfoProducImage($idProductImage);

                if(!$data) {

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

        case 'image':

            $idProductImage = $_POST['idProductImage'];

            if(strlen($idProductImage) > 0) {

                $image = new modelProductsImages();

                $data = $image -> mdlInfoProducImage($idProductImage);

                if(!$data) {

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

        default:

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
    }

}

?>