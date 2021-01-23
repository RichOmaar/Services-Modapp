<?php

include '../model/category.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    //$idClient = $_POST['idClient'];
    $action = $_POST['action'];

    switch($action) {

        case 'addCategory':

            $categoryName = $_POST['categoryName'];

            if(strlen($categoryName) > 0) {

                $addCategory =  new modelCategory();

                $data = $addCategory -> mdlAddCategory($categoryName);

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

        case 'updateCategory':
            
            $categoryName = $_POST['categoryName'];
            $idCategory = $_POST['idCategory'];

            if(strlen($categoryName) > 0 && strlen($idCategory) > 0) {

                $updateCategory =  new modelCategory();

                $data = $updateCategory -> mdlUpdateCategory($categoryName,$idCategory);

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

        case 'deleteCategory':

            $idCategory = $_POST['idCategory'];

            if(strlen($idCategory) > 0) {

                $deleteCategory =  new modelCategory();

                $data = $deleteCategory -> mdlDeleteCategory($idCategory);

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

        case 'infoCategory':

            $infoCategory =  new modelCategory();

            $data = $infoCategory -> mdlGeneralInfoCategory($infoCategory);

            if(!$data) {

                $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                    
                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            } else {

                $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

                echo json_encode($response, JSON_UNESCAPED_UNICODE);

            }

        break;

        default:

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE));
            
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
    }
}

?>