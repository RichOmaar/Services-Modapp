<?php

include '../model/partsClothing.model.php';

//$idClient = $_POST['idClient'];
$action = $_POST['action'];

switch($action) {

    case 'addPartClothing':

        $partName = $_POST['partName'];

        if(strlen($partName) > 0) {

            $addPart = new modelPartsClothing();

            $data = $addPart -> mdlAddPartClothing($partName);

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

    case 'updatePartClothing':

        $idPartClothing = $_POST['idPartClothing'];
        $partName = $_POST['partName'];

        if(strlen($idPartClothing) > 0 && strlen($partName) > 0) {

            $updatePart = new modelPartsClothing();

            $data = $updatePart -> mdlUpdatePartClothing($idPartClothing,$partName);

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

    case 'deletePartClothing':

        $idPartClothing = $_POST['idPartClothing'];

        if(strlen($idPartClothing) > 0) {

            $deletePart = new modelPartsClothing();

            $data = $deletePart -> mdlDeletePartClothing($idPartClothing);

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

    case 'allPartClothing':

        $allPart = new modelPartsClothing();

        $data = $allPart -> mdlGeneralInfoPartClothing();

        if(!$data) {

            $response = new Response(array('status' => Constants::BAD_RESPONSE, 'message' => Constants::BAD_RESPONSE_DESCRIPTION));
                
            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        } else {

            $response = new Response(array('status' => Constants::OK_RESPONSE, 'message' => $data));

            echo json_encode($response, JSON_UNESCAPED_UNICODE);

        }

    break;

    case 'selectedPartClothing':

        $idPartClothing = $_POST['idPartClothing'];

        if(strlen($idPartClothing) > 0) {

            $selectedPart = new modelPartsClothing();

            $data = $selectedPart -> mdlInfoPartClothing($idPartClothing);

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