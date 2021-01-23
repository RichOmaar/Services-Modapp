<?php

include '../model/body.model.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {

    //$idClient = $_POST['idClient'];
    $action = $_POST['action'];

    switch($action) {

        case 'addBody':
            
            $name = $_POST['name'];

            if(strlen($name) > 0) {

                $addBody = new modelBody();

                $data = $addBody -> mdlAddBody($name);

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

        case 'updateBody':
            
            $name = $_POST['name'];
            $idBody = $_POST['idBody'];

            if(strlen($name) > 0 && strlen($idBody) > 0) {

                $updateBody = new modelBody();

                $data = $updateBody -> mdlUpdateBody($name,$idBody);

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

        case 'generalInfoBody':

            $generalInfoBody = new modelBody();

            $data = $generalInfoBody -> mdlGeneralInfoBody();

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