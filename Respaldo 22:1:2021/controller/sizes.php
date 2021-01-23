<?php

include '../model/sizes.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addSize':

        $size = $_POST['size'];

        if(strlen($size) > 0) {

            $addSize = new modelSizes();

            $data = $addSize -> mdlAddSize($size);

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

    case 'updateSize':

        $idSize = $_POST['idSize'];
        $size = $_POST['size'];

        if(strlen($idSize) > 0 && strlen($size) > 0) {

            $updateSize = new modelSizes();

            $data = $updateSize -> mdlUpdateSize($idSize,$size);

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

    case 'deleteSize':
        
        $idSize = $_POST['idSize'];

            if(strlen($idSize) > 0) {

            $deleteSize = new modelSizes();

            $data = $deleteSize -> mdlDeleteSize($idSize);

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

    case 'allSizes':

        $sizes = new modelSizes();

        $data = $sizes -> mdlGeneralInfoSize();

        if(!$data) {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        }

    break;

    case 'selectedSize':

        $idSize = $_POST['idSize'];

        if(strlen($idSize) > 0) {

            $selectedSize = new modelSizes();

            $data = $selectedSize -> mdlInfoSize($idSize);

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