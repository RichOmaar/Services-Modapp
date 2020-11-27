<?php

include '../model/productRating.model.php';

$action = $_POST['action'];

$productRating = new modelProductRating();

switch($action) {
    /*Verificar que sea el primer comentario y que el comenrario no vaya vacío que no séa menos de 0 las estrellas*/
     case 'addRate':

        $idProduct = $_POST['idProduct'];
        $idUser = $_POST['idUser'];
        $content = $_POST['content'];
        $rate = $_POST['rate'];

        if(strlen($idProduct) > 0 && strlen($idUser) > 0 && strlen($content) > 0 && strlen($rate) > 0) {

            if($rate > 5) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Rating is greater than 5'));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {
                
                $addRate = $productRating -> mdlAddProductRating($idUser, $idProduct, $content, $rate);
            
                if(!$productRating) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                } else {

                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                    echo json_encode($response, JSON_UNESCAPED_UNICODE);

                }   

            }

        } else {
                    
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }

     break;

     case 'deleteRate':

        $idUser = $_POST['idUser'];
        $idProduct = $_POST['idProduct'];

        if(strlen($idProduct) > 0 && strlen($idUser) > 0) {
            
            $deleteRate = $productRating -> mdlDeleteProductRating($idProduct,$idUser);
            echo json_encode($deleteRate);

            if(!$deleteRate) {

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

     case 'updateRate':

        $idProductRating = $_POST['idProductRating'];
        $idUser = $_POST['idUser'];
        $content = $_POST['content'];
        $rate = $_POST['rate'];

        if(strlen($idProductRating) > 0 && strlen($idUser) > 0 && strlen($content) > 0 && strlen($rate) > 0) {
            
            if($rate > 5) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => 'Rating is greater than 5'));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else { 

                $updateReate = $productRating -> mdlUpdateProductRating($idUser,$content,$rate,$idProductRating);

                if(!$updateReate) {

                    $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                        
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                } else {
    
                    $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));
    
                    echo json_encode($response, JSON_UNESCAPED_UNICODE);
    
                }

            }

        } else {
                    
            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));

            echo json_encode($response, JSON_UNESCAPED_UNICODE); 
        }

     break;

     case 'showRate':
     break;

     default:

}

?>