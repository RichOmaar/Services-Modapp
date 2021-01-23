<?php

include '../model/colors.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addColor':

        $colorName = $_POST['colorName'];
        $hex = $_POST['hex'];

        if(strlen($colorName) > 0 && strlen($hex) > 0) {

            $addColor = new modelColors();

            $data = $addColor -> mdlAddColor($colorName, $hex);

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

    case 'deleteColor':

        $idColor = $_POST['idColor'];

        if(strlen($idColor) > 0) {

            $deleteColor = new modelColors();

            $data = $deleteColor -> mdlDeleteColor($idColor);

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

    case 'updateColor':

        $colorName = $_POST['colorName'];
        $hex = $_POST['hex'];
        $idColor = $_POST['idColor'];
        
        if(strlen($colorName) > 0 && strlen($hex) > 0 && strlen($idColor) > 0) {

            $updateColor = new modelColors();

            $data = $updateColor -> mdlUpdateColor($colorName, $hex, $idColor);

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

    case 'allColors':

        $allColors = new modelColors();

        $data = $allColors -> mdlGeneralInfoColor();

        if(!$data) {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        }

    break;

    case 'selectedColor':

        $idColor = $_POST['idColor'];

        if(strlen($idColor) > 0) {

            $color = new modelColors();

            $data = $color -> mdlInfoColor($idColor);

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

?>